<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\ItemCode;
use Livewire\Attributes\Modelable;

class ItemSelect extends Component
{
    #[Modelable]
    public $modelValue;
    public $options = [];

    public function mount()
    {
        $this->options = ItemCode::orderBy('name')->get(['id', 'name', 'description'])->toArray();
    }

    public function render()
    {
        return view('livewire.components.item-select');
    }
}
