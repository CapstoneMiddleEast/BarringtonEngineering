<?php

namespace App\Livewire\Accounting;

use App\Models\Supplier;
use Livewire\Component;

class StatementOfSupplier extends Component
{
    public $suppliers;

    public function mount()
    {

        $this->suppliers = Supplier::orderBy('name')->get();
    }
    public function render()
    {
        return view('livewire.accounting.statement-of-supplier');
    }
}
