<?php

namespace App\Livewire\MaterialRequest;

use App\Models\MaterialRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MaterialRequestForm extends Component
{
    public $mrId;
    public $project;
    public $purpose_of_use;
    public $requested_by;
    public $requested_date;
    public $reviewed_by;
    public $reviewed_date;
    public $approved_by;
    public $approved_date;

    public $items = [];

    public $users;
    public $materialOptions;
    public $unitOptions;

    protected function rules()
    {
        return [
            'requested_date' => 'required|date',
            'project' => 'required|string',
            'purpose_of_use' => 'required|string',

            'items' => 'required|array|min:1',
            'items.*.material_name' => 'required|string',
            'items.*.material_description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit' => 'required|string',
            'items.*.date_needed' => 'required|date',
            'items.*.scope_of_work' => 'string',
            'items.*.project_location' => 'string'
        ];
    }

    public function mount($mrId = null)
    {
        $this->materialOptions = config('material_requests.materials');
        $this->unitOptions = config('material_requests.units');

        if ($mrId) {
            $mr = MaterialRequest::with('items')->findOrFail($mrId);
            $this->mrId = $mr->id;
            $this->requested_date = $mr->requested_date;
            $this->project = $mr->project;
            $this->purpose_of_use = $mr->purpose_of_use;
            $this->requested_by = $mr->requested_by;
            $this->reviewed_by = $mr->reviewed_by;
            $this->approved_by = $mr->approved_by;

            foreach ($mr->items as $item) {

                $this->items[] = [
                    'material_name' => $item->material_name,
                    'material_description' => $item->material_description,
                    'quantity' => $item->quantity,
                    'unit' => $item->unit,
                    'date_needed' => $item->date_needed,
                    'scope_of_work' => $item->scope_of_work,
                    'project_location' => $item->project_location
                ];
            }
        } else {
            $this->requested_date = now()->format('Y-m-d');
            $this->addItem();
        }
    }

    public function addItem()
    {
        $this->items[] = [
            'material_name' => '',
            'material_description' => '',
            'quantity' => 1,
            'unit' => '',
            'date_needed' => '',
            'scope_of_work' => '',
            'project_location' => '',
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function save()
    {
        $this->validate();

        $mr = MaterialRequest::updateOrCreate(
            ['id' => $this->mrId],
            [
                'requested_date' => $this->requested_date,
                'project' => $this->project,
                'purpose_of_use' => $this->purpose_of_use,
                'requested_by' => $this->requested_by ?? Auth::id(),
            ]
        );

        $mr->items()->delete();

        foreach ($this->items as $itemData) {
            $item = $mr->items()->create([
                'material_name' => $itemData['material_name'],
                'material_description' => $itemData['material_description'],
                'quantity' => $itemData['quantity'],
                'unit' => $itemData['unit'],
                'date_needed' => $itemData['date_needed'],
                'scope_of_work' => $itemData['scope_of_work'],
                'project_location' => $itemData['project_location']
            ]);
        }
        session()->flash('type', 'success');
        session()->flash('message', 'Material Request saved successfully!');
        return redirect()->route('material_requests.index');
    }

    public function render()
    {
        return view('livewire.material-request.material-request-form');
    }
}
