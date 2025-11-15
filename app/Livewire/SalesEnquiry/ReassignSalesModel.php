<?php

namespace App\Livewire\SalesEnquiry;

use Livewire\Component;
use App\Models\SalesEnquiry;

class ReassignSalesModel extends Component
{

    public $salesId;

    public function mount($salesId)
    {
        $this->salesId = $salesId;
    }

    public function unassign()
    {
        $sales = SalesEnquiry::findOrFail($this->salesId);
        $sales->assigned_status = 'reassigned';
        $sales->save();

        activity()->performedOn($sales)->log('Sales enquiry "' . $sales->id . '" has been updated!');
        session()->flash('type', 'success');
        session()->flash('message', 'Sales enquiry updated successfully!');
        return redirect()->route('sales_enquiries.index');
    }
    public function render()
    {
        return view('livewire.sales-enquiry.reassign-sales-model');
    }
}
