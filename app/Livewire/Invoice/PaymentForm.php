<?php

namespace App\Livewire\Invoice;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use Livewire\Component;

class PaymentForm extends Component
{
    public $paymentId = null;
    public $client_id;
    public $invoice_id;
    public $amount = '';
    public $method = '';
    public $reference = '';
    public $paid_at;
    public $notes = '';

    public $invoices;
    public $clients;

    public $paymentOptions = [];

    protected function rules()
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
            'paid_at' => 'required|date',
            'notes' => 'nullable|string'
        ];
    }

    protected function validationAttributes()
    {
        $attributes = [
            'client_id' => 'Client Id',
            'invoice_id' => 'Invoice Id',
            'paid_at' => 'Paid date'
        ];

        return $attributes;
    }

    public function mount($paymentId = null)
    {

        $this->paymentOptions = config('invoice_data.payment_methods');
        $this->invoices = Invoice::with('client')->latest()->get();
        $this->clients = Client::orderBy('name')->get();
        $this->paid_at = now()->toDateString();

        if ($paymentId) {
            $payment = Payment::findOrFail($paymentId);
            $this->paymentId = $payment->id;
            $this->client_id = $payment->client_id;
            $this->invoice_id = $payment->invoice_id;
            $this->amount = $payment->amount;
            $this->method = $payment->method;
            $this->reference = $payment->reference;
            $this->paid_at = $payment->paid_at;
            $this->notes = $payment->notes;
        }
    }

    public function updatedInvoiceId($value)
    {
        $invoice = Invoice::with('client')->find($value);
        $this->client_id = $invoice?->client_id;
    }

    public function save()
    {
        $this->validate();

        $payment = Payment::updateOrCreate(
            ['id' => $this->paymentId],
            [
                'client_id' => $this->client_id,
                'invoice_id' => $this->invoice_id,
                'amount' => $this->amount,
                'method' => $this->method,
                'reference' => $this->reference,
                'paid_at' => $this->paid_at,
                'notes' => $this->notes,
            ]
        );

        session()->flash('type', 'success');
        session()->flash('message', 'Payment saved successfully!');
        return redirect()->route('payments.index');
    }

    public function render()
    {
        return view('livewire.invoice.payment-form');
    }
}
