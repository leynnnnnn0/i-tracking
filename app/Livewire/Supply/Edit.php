<?php

namespace App\Livewire\Supply;

use App\Enum\Unit;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\SupplyForm;
use App\Models\Category;
use App\Models\Supply;
use Exception;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public ActivityLogForm $activityLogForm;
    public SupplyForm $form;
    public $units;
    public $categories;
    public $supply;
    public function mount($id)
    {
        $this->supply = Supply::with('categories')->findOrFail($id);
        $this->units = Unit::values();
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->form->setSupply($this->supply);
    }
    public function render()
    {
        return view('livewire.supply.edit');
    }

    public function edit()
    {
        try {
            $after = $this->form->update($this->supply);
            $this->activityLogForm->setActivityLog($this->supply, $after, 'Updated Supply', 'Update');
            $this->activityLogForm->store();
            Toaster::success('Supply Updated!');
            return $this->redirect('/supplies');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }

    public function addToCategories($id)
    {
        $categoriesArray = $this->form->category->toArray();
        if (in_array($id, $categoriesArray)) {
            $this->form->category = collect(array_diff($categoriesArray, [$id]));
            return;
        }
        $this->form->category->push((int)$id);
    }
}
