<?php

namespace App\Livewire;

use App\Helper\ColorStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\SupplyForm;
use App\Livewire\Forms\SupplyHistoryForm;
use App\Models\Category;
use App\Models\Supply as ModelsSupply;
use App\Traits\Deletable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Supply extends Component
{
    use WithPagination, Deletable;
    public ActivityLogForm $activityLogForm;
    public SupplyForm $form;
    public SupplyHistoryForm $supplyHistoryForm;
    public $keyword;
    public $categories;
    public $category = [];

    public function updatedKeyword()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    protected function getModel(): string
    {
        return ModelsSupply::class;
    }

    public function mount()
    {
        $this->categories = Category::toSelectOptions();
    }

    public function render()
    {
        $query = ModelsSupply::query()->with('categories');

        if ($this->keyword) {
            $query->whereAny(['description', 'id'], 'like', '%' . $this->keyword . '%');
        }

        if ($this->category) {
            if ($this->category && is_array($this->category)) {
                $query->whereHas('categories', function ($q) {
                    $q->whereIn('categories.id', $this->category);
                });
            }
        }

        $supplies = $query->orderBy('total')->paginate(10);
        return view('livewire.supply', [
            'data' => $supplies
        ]);
    }

    public function downloadPdf()
    {
        $params = [
            'category' => $this->category,
            'keyword' => $this->keyword
        ];

        return redirect()->route('supplies-list-pdf', $params);
    }

    public function resetFilter()
    {
        $this->resetPage();
        $this->keyword = null;
        $this->category = [];
    }

    public function getColor($total)
    {
        return ColorStatus::getTotalColor($total);
    }

    public function add($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $before = ModelsSupply::findOrFail($id);
                $after = $this->form->updateUsedValue($before);
                $this->activityLogForm->setActivityLog($before, $after, 'Add Supply Quanity', 'Update');
                $this->activityLogForm->store();
                $this->supplyHistoryForm->setSupplyHistoryForm($after);
                $this->supplyHistoryForm->store();
            });
            Toaster::success('Updated Successfully');
            $this->dispatch('usedValueUpdated');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }


    public function addQuantity($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $before = ModelsSupply::findOrFail($id);
                $after = $this->form->updateQuantity($before);
                $this->activityLogForm->setActivityLog($before, $after, 'Update Quantity', 'Update');
                $this->activityLogForm->store();
                $this->supplyHistoryForm->setSupplyHistoryForm($after);
                $this->supplyHistoryForm->store();
            });
            Toaster::success('Quantity Updated');
            $this->dispatch('quantityValueUpdated');
        } catch (Exception $e) {
            Toaster::error('Something went wrong: ' . $e->getMessage());
        }
    }
}
