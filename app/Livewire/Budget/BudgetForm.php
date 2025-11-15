<?php

namespace App\Livewire\Budget;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\Budget;
use Illuminate\Support\Facades\Storage;

class BudgetForm extends Component
{
    use WithFileUploads, WithPagination;

    public $project_name, $file;
    public $showModal = false;
    public $showConfirmModal = false;
    public $selectedBudgetId;
    public $newFile;

    protected function rules()
    {
        return [
            'project_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:xls,xlsx,pdf|max:5120',
        ];
    }

    public function submit()
    {
        $this->validate();

        $path = $this->file->store('budgets', 'public');

        Budget::create([
            'project_name' => $this->project_name,
            'date_files_uploaded' => now()->toDateString(),
            'file_path' => $path,
        ]);

        session()->flash('message', 'Budget file uploaded successfully!');
        $this->reset(['project_name', 'file']);
    }

    public function openModal($id)
    {
        $this->selectedBudgetId = $id;
        $this->showModal = true;
        $this->resetValidation();
    }

    public function openConfirmModal($id)
    {
        $this->selectedBudgetId = $id;
        $this->showConfirmModal = true;
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
    }

    public function updateFile()
    {
        $this->validate([
            'newFile' => 'required|file|mimes:xls,xlsx,pdf|max:5120',
        ]);

        $budget = Budget::findOrFail($this->selectedBudgetId);

        // Delete old file
        if ($budget->file_path && Storage::disk('public')->exists($budget->file_path)) {
            Storage::disk('public')->delete($budget->file_path);
        }

        // Upload new file
        $newPath = $this->newFile->store('budgets', 'public');

        $budget->update([
            'file_path' => $newPath,
            'date_files_uploaded' => now()->toDateString(),
        ]);

        session()->flash('message', 'File updated successfully!');
        $this->reset(['showModal', 'newFile', 'selectedBudgetId']);
    }

    #[On('remove-todo')]
    public function deleteBudget()
    {
        $budget = Budget::findOrFail($this->selectedBudgetId);

        if ($budget->file_path && Storage::disk('public')->exists($budget->file_path)) {
            Storage::disk('public')->delete($budget->file_path);
        }
        $budget->delete();
        session()->flash('message', 'Budget and file deleted successfully!');
        $this->resetPage();
        $this->showConfirmModal = false;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.budget.budget-form', [
            'budgets' => Budget::latest()->paginate(10)
        ]);
    }
}
