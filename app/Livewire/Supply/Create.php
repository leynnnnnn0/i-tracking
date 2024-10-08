<?php

namespace App\Livewire\Supply;

use App\Enum\Unit;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\SupplyForm;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public ActivityLogForm $activityLogForm;
    public SupplyForm $form;
    public $units;
    public $categories;


    public function mount()
    {
        $this->units = Unit::values();
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->form->category = [];
    }

    public function save()
    {
        DB::transaction(function () {
            $supply = $this->form->store();
            $this->activityLogForm->setActivityLog(null, $supply, 'Supply Created', 'Create');
            $this->activityLogForm->store();
            Toaster::success('Created Successfully.');
            return $this->redirect('/supplies');
        });
    }

    public function addToCategories($id)
    {
        $categoriesArray = $this->form->category;
        if (in_array($id, $categoriesArray)) {
            $this->form->category = array_diff($categoriesArray, [$id]);
            return;
        }
        $this->form->category[] = (int)$id;
    }

    public function render()
    {
        return view('livewire.supply.create');
    }
}
