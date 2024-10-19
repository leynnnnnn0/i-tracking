<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public $category;
    public CategoryForm $form;
    public ActivityLogForm $activityLogForm;
    public function mount($id)
    {
        $this->category = Category::findOrFail($id);
        $this->form->setCategoryForm($this->category);
    }
    public function render()
    {
        return view('livewire.category.edit');
    }
    public function update()
    {
        $this->dispatch('Confirm Update');
        try {
            DB::transaction(function () {
                $category = $this->form->update($this->category);
                $this->activityLogForm->setActivityLog($this->category, $category, 'Updated Category', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return $this->redirect('/categories');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }
}
