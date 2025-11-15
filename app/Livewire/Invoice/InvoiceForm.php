<?php

namespace App\Livewire\Invoice;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Supplier;

class InvoiceForm extends Component
{

    public $invoiceId = null;
    public $invoice_no;
    public $client_id;
    public $invoice_date;
    public $client_invoice;
    public $lpo_no;
    public $unitOptions;
    public $items = [];

    protected function rules()
    {
        return [
            'invoice_no' => 'required|string|max:255|unique:invoices,invoice_no,' . $this->invoiceId,
            'client_id' => 'required|exists:clients,id',
            'invoice_date' => 'required|date',
            'client_invoice' => 'required|string|max:255',
            'lpo_no' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:item_codes,id',
            'items.*.delivery_date' => 'required|date',
            'items.*.unit' => 'required|string|max:50',
            'items.*.quantity' => 'required|numeric|min:0',
            'items.*.client_unit_price' => 'required|numeric|min:0',
            'items.*.client_total_price' => 'required|numeric|min:0',
            'items.*.client_vat' => 'required|numeric|min:0',
            'items.*.client_total_price_vat' => 'required|numeric|min:0',
            'items.*.suppliers.*.supplier_id' => 'required|exists:suppliers,id',
            'items.*.suppliers.*.supplier_quantity' => 'required|numeric|min:0',
            'items.*.suppliers.*.supplier_unit_price' => 'required|numeric|min:0',
            'items.*.suppliers.*.supplier_total_price' => 'required|numeric|min:0',
            'items.*.suppliers.*.supplier_vat' => 'required|numeric|min:0',
            'items.*.suppliers.*.supplier_total_price_vat' => 'required|numeric|min:0',
        ];
    }

    public function mount($invoiceId = null)
    {
        $this->unitOptions = config('invoice_data.units');
        if ($invoiceId) {
            $invoice = Invoice::with('items.suppliers')->findOrFail($invoiceId);
            $this->invoiceId = $invoice->id;
            $this->invoice_no = $invoice->invoice_no;
            $this->client_id = $invoice->client_id;
            $this->invoice_date = $invoice->invoice_date;
            $this->client_invoice = $invoice->client_invoice;
            $this->lpo_no = $invoice->lpo_no;

            foreach ($invoice->items as $item) {
                $suppliers = [];
                foreach ($item->suppliers as $supplier) {
                    $suppliers[] = [
                        'supplier_id' => $supplier->supplier_id,
                        'supplier_invoice' => $supplier->supplier_invoice,
                        'supplier_quantity' => $supplier->supplier_quantity,
                        'supplier_unit_price' => $supplier->supplier_unit_price,
                        'supplier_total_price' => $supplier->supplier_total_price,
                        'supplier_vat' => $supplier->supplier_vat,
                        'supplier_total_price_vat' => $supplier->supplier_total_price_vat,
                    ];
                }

                $this->items[] = [
                    'item_id' => $item->item_id,
                    'delivery_date' => $item->delivery_date,
                    'unit' => $item->unit,
                    'do_no' => $item->do_no,
                    'ticket_no' => $item->ticket_no,
                    'vehicle_no' => $item->vehicle_no,
                    'delivery_point' => $item->delivery_point,
                    'quantity' => $item->quantity,
                    'client_unit_price' => $item->client_unit_price,
                    'client_total_price' => $item->client_total_price,
                    'client_vat' => $item->client_vat,
                    'client_total_price_vat' => $item->client_total_price_vat,
                    'suppliers' => $suppliers ?: [$this->defaultSupplier()],
                ];
            }
        } else {
            $this->items = [
                [
                    'item_id' => '',
                    'delivery_date' => '',
                    'unit' => '',
                    'do_no' => '',
                    'ticket_no' => '',
                    'vehicle_no' => '',
                    'delivery_point' => '',
                    'quantity' => '',
                    'client_unit_price' => '',
                    'client_total_price' => '',
                    'client_vat' => '',
                    'client_total_price_vat' => '',
                    'suppliers' => [
                        $this->defaultSupplier()
                    ],
                ],
            ];
        }
    }

    public function defaultSupplier()
    {
        return [
            'supplier_id' => '',
            'supplier_invoice' => '',
            'supplier_quantity' => '',
            'supplier_unit_price' => '',
            'supplier_total_price' => '',
            'supplier_vat' => '',
            'supplier_total_price_vat' => '',
        ];
    }

    public function addItem()
    {
        $this->items[] = [
            'item_id' => '',
            'delivery_date' => '',
            'unit' => '',
            'do_no' => '',
            'ticket_no' => '',
            'vehicle_no' => '',
            'delivery_point' => '',
            'quantity' => '',
            'client_unit_price' => '',
            'client_total_price' => '',
            'client_vat' => '',
            'client_total_price_vat' => '',
            'suppliers' => [
                $this->defaultSupplier()
            ],
        ];
    }

    public function removeItem($index)
    {
        if (count($this->items) > 1) {
            array_splice($this->items, $index, 1);
        }
    }

    public function addSupplier($itemIndex)
    {
        $this->items[$itemIndex]['suppliers'][] = $this->defaultSupplier();
    }

    public function removeSupplier($itemIndex, $supplierIndex)
    {
        $suppliers = $this->items[$itemIndex]['suppliers'];
        unset($suppliers[$supplierIndex]);
        $suppliers = array_values($suppliers); // reindex the array
        $this->items[$itemIndex]['suppliers'] = $suppliers;
    }

    public function calculateTotals()
    {
        foreach ($this->items as $index => $item) {
            $quantity = (float) ($item['quantity'] ?? 0);
            $unitPrice = (float) ($item['client_unit_price'] ?? 0);
            $vat = (float) ($item['client_vat'] ?? 0);

            $total = $quantity * $unitPrice;
            $totalVat = $total + ($total * $vat / 100);

            $this->items[$index]['client_total_price'] = round($total, 2);
            $this->items[$index]['client_total_price_vat'] = round($totalVat, 2);

            // Handle supplier calculations if present
            if (isset($item['suppliers'])) {
                foreach ($item['suppliers'] as $sIndex => $supplier) {
                    $sQty = (float) ($supplier['supplier_quantity'] ?? 0);
                    $sUnit = (float) ($supplier['supplier_unit_price'] ?? 0);
                    $sVat = (float) ($supplier['supplier_vat'] ?? 0);
                    $sTotal = $sQty * $sUnit;
                    $sTotalVat = $sTotal + ($sTotal * $sVat / 100);

                    $this->items[$index]['suppliers'][$sIndex]['supplier_total_price'] = round($sTotal, 2);
                    $this->items[$index]['suppliers'][$sIndex]['supplier_total_price_vat'] = round($sTotalVat, 2);
                }
            }
        }
    }

    public function save()
    {
        $this->validate();

        $invoice = Invoice::updateOrCreate(
            ['id' => $this->invoiceId],
            [
                'invoice_no' => $this->invoice_no,
                'client_id' => $this->client_id,
                'invoice_date' => $this->invoice_date,
                'client_invoice' => $this->client_invoice,
                'lpo_no' => $this->lpo_no,
            ]
        );

        $invoice->items()->delete();

        foreach ($this->items as $itemData) {
            $item = $invoice->items()->create([
                'item_id' => $itemData['item_id'],
                'delivery_date' => $itemData['delivery_date'],
                'unit' => $itemData['unit'],
                'do_no' => $itemData['do_no'],
                'ticket_no' => $itemData['ticket_no'],
                'vehicle_no' => $itemData['vehicle_no'],
                'delivery_point' => $itemData['delivery_point'],
                'quantity' => $itemData['quantity'],
                'client_unit_price' => $itemData['client_unit_price'],
                'client_total_price' => $itemData['client_total_price'],
                'client_vat' => $itemData['client_vat'],
                'client_total_price_vat' => $itemData['client_total_price_vat'],
            ]);

            foreach ($itemData['suppliers'] as $supplierData) {
                $item->suppliers()->create($supplierData);
            }
        }
        session()->flash('type', 'success');
        session()->flash('message', 'Invoice saved successfully!');
        return redirect()->route('invoices.index');
    }

    public function render()
    {
        return view('livewire.invoice.invoice-form', [
            'clients' => Client::all(),
            'suppliers' => Supplier::all(),
        ]);
    }
}
