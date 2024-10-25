<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use App\Traits\Updatable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    use Updatable;
    public $category;
    public CategoryForm $form;

    protected function getRedirectRoute(): string
    {
        return 'categories';
    }


    protected function getEloquentModel()
    {
        return $this->category;
    }

    public function mount($id)
    {
        $this->category = Category::findOrFail($id);
        $this->form->setCategoryForm($this->category);
    }
    public function render()
    {
        return view('livewire.category.edit');
    }
}
