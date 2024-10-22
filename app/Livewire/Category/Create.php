<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\CategoryForm;
use App\Traits\Submittable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    use Submittable;
    public CategoryForm $form;
    public ActivityLogForm $activityLogForm;
    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'category';
    }
    public function render()
    {
        return view('livewire.category.create');
    }

}
