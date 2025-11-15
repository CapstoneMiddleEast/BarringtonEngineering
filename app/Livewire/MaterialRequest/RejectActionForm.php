<?php

namespace App\Livewire\MaterialRequest;

use App\Models\MaterialRequestItem;
use Livewire\Component;

class RejectActionForm extends Component
{
    public $materialRequestId;
    public $items = [];

    public function mount($materialRequestId)
    {
        $this->materialRequestId = $materialRequestId;

        $this->items = MaterialRequestItem::where('material_request_id', $materialRequestId)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'material_name' => $item->material_name,
                    'material_description' => $item->material_description,
                    'rejected' => $item->rejected,
                    'rejected_reason' => $item->rejected_reason,
                ];
            })
            ->toArray();
    }

    public function saveRejections()
    {
        foreach ($this->items as $itemData) {
            $reason = trim($itemData['rejected_reason']);
            $isRejected = !empty($reason);

            MaterialRequestItem::where('id', $itemData['id'])
                ->update([
                    'rejected' => $isRejected,
                    'rejected_reason' => $isRejected ? $itemData['rejected_reason'] : null,
                ]);
        }
        return redirect()->route('material_requests.view', $this->materialRequestId);
    }
    
    public function render()
    {
        return view('livewire.material-request.reject-action-form');
    }
}
