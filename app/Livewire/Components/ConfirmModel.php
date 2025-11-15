<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ConfirmModel extends Component
{
    public function remove()
    {
        $this->dispatch('remove-todo');
    }

    public function render()
    {
        return view('livewire.components.confirm-model');
    }
}
