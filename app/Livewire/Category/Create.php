<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\CategoryForm;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public CategoryForm $form;
    public ActivityLogForm $activityLogForm;
    public function render()
    {
        return view('livewire.category.create');
    }
    public function submit()
    {
        try {
            DB::transaction(function () {
                $category = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $category, 'Created Category', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return $this->redirect('/categories');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
