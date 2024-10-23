<?php

namespace App\Livewire\Supply;

use App\Enum\Unit;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\SupplyForm;
use App\Livewire\Forms\SupplyHistoryForm;
use App\Models\Category;
use App\Models\SupplyHistory;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public ActivityLogForm $activityLogForm;
    public SupplyForm $form;
    public SupplyHistoryForm $supplyHistoryForm;
    public $units;
    public $categories;
    protected function afterTransaction($model)
    {
        $this->supplyHistoryForm->setSupplyHistoryForm($model);
        $this->supplyHistoryForm->store();
    }

    protected function getModelName(): string
    {
        return 'supply';
    }

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    public function mount()
    {
        $this->units = Unit::values();
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->form->category = [];
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
