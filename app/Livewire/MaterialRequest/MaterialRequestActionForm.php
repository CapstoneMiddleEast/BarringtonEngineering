<?php

namespace App\Livewire\MaterialRequest;

use App\Models\MaterialRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Carbon;

class MaterialRequestActionForm extends Component
{
    public $status;
    public $mrId;

    public function mount($mrId = null)
    {
        $this->mrId = $mrId;
        $mr = MaterialRequest::findOrFail($mrId);
        if ($mr->reviewed_by) {
            $this->status = 'approved';
        } else {
            $this->status = 'reviewed';
        }
    }

    public function mark()
    {
        $request = MaterialRequest::findOrFail($this->mrId);

        if ($this->status === 'reviewed') {
            $request->reviewed_by = Auth::id();
            $request->reviewed_date = Carbon::now()->toDateString();
            $request->save();
            session()->flash('success', 'Marked as reviewed.');
            return redirect()->route('material_requests.view', $this->mrId);
        } elseif ($this->status === 'approved') {
            $request->approved_by = Auth::id();
            $request->approved_date = Carbon::now()->toDateString();
            $request->save();
            session()->flash('success', 'Marked as approved.');
            return redirect()->route('material_requests.view', $this->mrId);
        } else {
            session()->flash('error', 'Invalid status action.');
            return redirect()->route('material_requests.view', $this->mrId);
        }

    }

    public function render()
    {
        return view('livewire.material-request.material-request-action-form');
    }
}
