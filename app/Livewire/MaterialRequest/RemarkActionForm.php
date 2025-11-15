<?php

namespace App\Livewire\MaterialRequest;

use App\Models\MaterialRequestItem;
use Livewire\Component;

class RemarkActionForm extends Component
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
                    'remark' => $item->remark,
                ];
            })
            ->toArray();
    }

    public function saveRemarks()
    {
        foreach ($this->items as $itemData) {
            MaterialRequestItem::where('id', $itemData['id'])
                ->update([
                    'remark' => $itemData['remark']
                ]);
        }
        return redirect()->route('material_requests.view', $this->materialRequestId);
    }

    public function render()
    {
        return view('livewire.material-request.remark-action-form');
    }
}
