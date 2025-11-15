<?php

namespace App\Livewire\Accounting;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use Livewire\Component;

class StatementOfClient extends Component
{
    public $clients;
    public $client_id = null;
    public $from_date = null;
    public $to_date   = null;

    public $client;
    public $rows = [];
    public $opening_balance = 0.0;
    public $closing_balance = 0.0;
    public float $total_invoices = 0.0;
    public float $total_payments = 0.0;
    public float $net            = 0.0;

    public function mount()
    {

        $this->clients = Client::orderBy('name')->get();
    }

    public function selectDates($period)
    {
        $today = Carbon::today();
        switch ($period) {
            case '1m':
                $this->from_date = $today->copy()->subMonth()->toDateString();
                break;
            case '3m':
                $this->from_date = $today->copy()->subMonths(3)->toDateString();
                break;
            case '6m':
                $this->from_date = $today->copy()->subMonths(6)->toDateString();
                break;
            case '1y':
                $this->from_date = $today->copy()->subYear()->toDateString();
                break;
        }
        $this->to_date = $today->toDateString();
        $this->loadSOA();
    }

    public function loadSOA()
    {
        $this->client = Client::findOrFail($this->client_id);

        $rows = collect();

        // --- Opening Balance (before from_date)
        $invoicesBefore = Invoice::where('client_id', $this->client_id)
            ->when($this->from_date, fn($q) => $q->where('invoice_date', '<', $this->from_date))
            ->with('items')
            ->get();

        $paymentsBefore = Payment::whereHas('invoice', fn($q) => $q->where('client_id', $this->client_id))
            ->when($this->from_date, fn($q) => $q->where('paid_at', '<', $this->from_date))
            ->get();

        $invoicesBeforeTotal = $invoicesBefore->sum(fn($inv) => $inv->items->sum('client_total_price_vat'));
        $paymentsBeforeTotal = $paymentsBefore->sum('amount');

        $this->opening_balance = $invoicesBeforeTotal - $paymentsBeforeTotal;
        $balance = $this->opening_balance;

        // --- Current Period Invoices
        $invoices = Invoice::where('client_id', $this->client_id)
            ->when($this->from_date, fn($q) => $q->where('invoice_date', '>=', $this->from_date))
            ->when($this->to_date, fn($q) => $q->where('invoice_date', '<=', $this->to_date))
            ->with('items.item')
            ->get();

        foreach ($invoices as $invoice) {
            $invoiceTotal = (float) $invoice->items->sum('client_total_price_vat');
            $descriptions = $invoice->items->pluck('item.description')->filter()->toArray();

            if (count($descriptions) === 1) {
                $descriptionText = 'SUPPLY OF ' . $descriptions[0];
            } else {
                $descriptionText = 'SUPPLY OF ' . implode(' & ', $descriptions);
            }

            $balance += $invoiceTotal;

            $rows->push([
                'date'        => $invoice->invoice_date,
                'type'        => 'Invoice',
                'ref'         => $invoice->invoice_no,
                'lpo_no'      => $invoice->lpo_no,
                'description' => $descriptionText,
                'debit'       => $invoiceTotal,
                'credit'      => null,
                'balance'     => $balance,
            ]);
        }

        // --- Current Period Payments
        $payments = Payment::whereHas('invoice', fn($q) => $q->where('client_id', $this->client_id))
            ->when($this->from_date, fn($q) => $q->where('paid_at', '>=', $this->from_date))
            ->when($this->to_date, fn($q) => $q->where('paid_at', '<=', $this->to_date))
            ->with('invoice')
            ->get();

        foreach ($payments as $payment) {

            $balance -= $payment->amount;

            $rows->push([
                'date'        => $payment->paid_at,
                'type'        => 'Payment',
                'ref'         => $payment->reference,
                'lpo_no'      => '--',
                'description' => 'PAYMENT FOR INV. ' . ($payment->invoice->invoice_no ?? 'N/A'),
                'debit'       => null,
                'credit'      => (float) $payment->amount,
                'balance'     => $balance,
            ]);
        }

        // --- Sort by Date
        $rows = $rows->sortBy('date')->values();

        // --- Period Totals
        $this->total_invoices = $rows->sum('debit');
        $this->total_payments = $rows->sum('credit');
        $this->net = $this->total_invoices - $this->total_payments;

        // --- Closing Balance
        $this->closing_balance = $this->opening_balance + $this->net;

        $this->rows = $rows;
    }

    public function render()
    {
        return view('livewire.accounting.statement-of-client');
    }
}
