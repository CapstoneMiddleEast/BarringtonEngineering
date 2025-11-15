<?php

namespace App\Livewire\SalesEnquiry;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SalesEnquiry;
use App\Models\User;
use Carbon\Carbon;

class SalesEnquiryForm extends Component
{
    use WithFileUploads;

    public $salesId;
    public $itemCodeData = [];
    public $inquiry_date_received, $assigned_sales_person_id, $client_name, $delivery_point;
    public $date_sent_quotation_to_client, $date_follow_up_to_client, $quotation_status;
    public $lpo_received, $remark, $contact_person, $contact_no, $email, $quotation_no;
    public $follow_up, $lpo_received_text, $lpo_no, $lpo_doc, $quotation_revision, $payment_terms;
    public $mode = 'create';

    public $unitOptions;
    public $users;
    public $revisions;
    public $status;

    protected function rules()
    {
        return [
            'itemCodeData' => 'required|array|min:1',
            'itemCodeData.*.item_code' => 'required|exists:item_codes,id',
            'itemCodeData.*.quantity' => 'required|numeric|min:1',
            'itemCodeData.*.unit' => 'required|string',
            'itemCodeData.*.buying_price' => 'required|numeric|min:0',
            'itemCodeData.*.selling_price' => 'required|numeric|min:0',
            'inquiry_date_received' => 'required|date',
            'assigned_sales_person_id' => 'required|exists:users,id',
            'client_name' => 'required|string|max:255',
            'delivery_point' => 'required|string|max:255',
            'date_sent_quotation_to_client' => 'nullable|date|after_or_equal:inquiry_date_received',
            'date_follow_up_to_client' => 'nullable|date',
            'quotation_status' => 'required|string|in:Pending,Approved,In-Progress,Quotation-Sent,Rejected,Accomplished,Regret',
            'lpo_received' => 'required|string|in:YES,NO',
            'remark' => 'nullable|string',
            'contact_person' => 'required|string|max:255',
            'contact_no' => 'required|numeric',
            'email' => 'nullable|email',
            'quotation_no' => 'nullable|string|max:255',
            'follow_up' => 'nullable|string',
            'lpo_received_text' => 'nullable|string',
            'payment_terms' => 'required|string',
            'lpo_no' => 'nullable|string',
            'lpo_doc' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ];
    }

    protected function validationAttributes()
    {
        $attributes = [
            'inquiry_date_received' => 'Inquiry Date Received',
            'assigned_sales_person_id' => 'Assigned Sales Person',
            'client_name' => 'Client Name',
            'delivery_point' => 'Delivery Point',
            'date_sent_quotation_to_client' => 'Quotation Sent Date',
            'date_follow_up_to_client' => 'Follow Up Date',
            'quotation_status' => 'Quotation Status',
            'lpo_received' => 'LPO Received',
            'remark' => 'Remark',
            'contact_person' => 'Contact Person',
            'contact_no' => 'Contact Number',
            'email' => 'Email',
            'quotation_no' => 'Quotation Number',
            'follow_up' => 'Follow Up',
            'lpo_received_text' => 'LPO Received Text',
            'payment_terms' => 'Payment Terms',
            'lpo_no' => 'LPO Number',
            'lpo_doc' => 'LPO Document',
        ];

        // Dynamic attributes for itemCodeData
        foreach ($this->itemCodeData as $index => $item) {
            $row = $index + 1;
            $attributes["itemCodeData.$index.item_code"] = "Item Code (Item $row)";
            $attributes["itemCodeData.$index.quantity"] = "Quantity (Item $row)";
            $attributes["itemCodeData.$index.unit"] = "Unit (Item $row)";
            $attributes["itemCodeData.$index.buying_price"] = "Buying Price (Item $row)";
            $attributes["itemCodeData.$index.selling_price"] = "Selling Price (Item $row)";
        }

        return $attributes;
    }

    public function mount($salesId = null)
    {
        $this->payment_terms = 'CASH ON DELIVERY';
        $this->unitOptions = config('sales_enquiries.units');
        $this->users = User::orderBy('name', 'ASC')->get();
        $this->status = config('sales_enquiries.status');
        $this->revisions = config('sales_enquiries.revision');

        if ($salesId) {
            $this->mode = 'update';
            $sales = SalesEnquiry::findOrFail($salesId);
            $this->salesId = $sales->id;
            $this->inquiry_date_received = optional($sales->inquiry_date_received)->format('Y-m-d');
            $this->date_sent_quotation_to_client = optional($sales->date_sent_quotation_to_client)->format('Y-m-d');
            $this->date_follow_up_to_client = optional($sales->date_follow_up_to_client)->format('Y-m-d');
            $this->assigned_sales_person_id = $sales->assigned_sales_person_id;
            $this->client_name = $sales->client_name;
            $this->delivery_point = $sales->delivery_point;
            $this->quotation_status = $sales->quotation_status;
            $this->lpo_received = $sales->lpo_received;
            $this->remark = $sales->remark;
            $this->contact_person = $sales->contact_person;
            $this->contact_no = $sales->contact_no;
            $this->email = $sales->email;
            $this->quotation_no = $sales->quotation_no;
            $this->follow_up = $sales->follow_up;
            $this->lpo_received_text = $sales->lpo_received_text;
            $this->payment_terms = $sales->payment_terms;
            $this->lpo_no = $sales->lpo_no;
            $this->lpo_doc = $sales->lpo_doc;
            $this->itemCodeData = $sales->itemCodes->map(function ($item) {
                return [
                    'item_code' => $item->id,
                    'quantity' => $item->pivot->quantity,
                    'unit' => $item->pivot->unit,
                    'buying_price' => $item->pivot->buying_price,
                    'selling_price' => $item->pivot->selling_price,
                ];
            })->toArray();
        } else {
            $this->itemCodeData = [
                [
                    'item_code' => '',
                    'quantity' => 1,
                    'unit' => '',
                    'buying_price' => 0,
                    'selling_price' => 0,
                ]
            ];
        }
    }

    public function addItem()
    {
        $this->itemCodeData[] = [
            'item_code' => '',
            'quantity' => 1,
            'unit' => '',
            'buying_price' => 0,
            'selling_price' => 0,
        ];
    }

    public function removeItem($index)
    {
        unset($this->itemCodeData[$index]);
        $this->itemCodeData = array_values($this->itemCodeData); // reindex
    }

    public function save()
    {
        $this->validate();

        $dateReceived = Carbon::parse($this->inquiry_date_received);
        $daysTaken = $this->date_sent_quotation_to_client
            ? $dateReceived->diffInDays(Carbon::parse($this->date_sent_quotation_to_client))
            : null;

        if ($this->mode === 'update') {
            $sales = SalesEnquiry::findOrFail($this->salesId);
        } else {
            $sales = new SalesEnquiry();
            $sales->author_id = Auth::user()->id;
        }

        $sales->fill([
            'inquiry_date_received' => $this->inquiry_date_received,
            'assigned_sales_person_id' => $this->assigned_sales_person_id,
            'client_name' => $this->client_name,
            'delivery_point' => $this->delivery_point,
            'date_sent_quotation_to_client' => $this->date_sent_quotation_to_client,
            'date_follow_up_to_client' => $this->date_follow_up_to_client,
            'quotation_status' => $this->quotation_status,
            'lpo_received' => $this->lpo_received,
            'no_of_days_taken_for_preparing_quotation' => $daysTaken,
            'remark' => $this->remark,
            'contact_person' => $this->contact_person,
            'contact_no' => $this->contact_no,
            'email' => $this->email,
            'follow_up' => $this->follow_up,
            'lpo_received_text' => $this->lpo_received_text,
            'payment_terms' => $this->payment_terms,
            'lpo_no' => $this->lpo_no,
        ]);

        if ($this->lpo_doc) {
            $sales->lpo_doc = $this->lpo_doc->store('lpo_doc', 'public');
        }

        $sales->save();

        if ($this->mode === 'create') {
            $year = now()->year;
            $id = str_pad($sales->id, 3, '0', STR_PAD_LEFT);
            $rev = $this->quotation_revision ?: '';
            $sales->quotation_no = $rev ? "BV-{$year}-{$id}-{$rev}" : "BV-{$year}-{$id}";
            $sales->save();
        }
        $pivotData = [];
        foreach ($this->itemCodeData as $item) {
            $pivotData[$item['item_code']] = [
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'buying_price' => $item['buying_price'],
                'selling_price' => $item['selling_price'],
            ];
        }
        $sales->itemCodes()->sync($pivotData);
        activity()->performedOn($sales)->log('Sales enquiry "' . $sales->id . '" has been ' . ($this->mode === 'create' ? 'added' : 'updated') . '!');
        session()->flash('type', 'success');
        session()->flash('message', 'Sales enquiry ' . ($this->mode === 'create' ? 'added' : 'updated') . ' successfully!');
        return redirect()->route($this->mode === 'create' ? 'sales_enquiries.index' : 'sales_enquiries.view', $sales->id);
    }

    public function render()
    {
        return view('livewire.sales-enquiry.sales-enquiry-form');
    }
}
