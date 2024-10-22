<?php

namespace App\Livewire;

use App\Helper\ColorStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\SupplyForm;
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
    public $keyword;
    public $categories;
    public $category;

    protected function getModel(): string
    {
        return ModelsSupply::class;
    }

    public function mount()
    {
        $this->categories = Category::all()->pluck('name', 'id');
    }

    public function render()
    {
        $query = ModelsSupply::query();

        if ($this->keyword) {
            $query->whereAny(['description', 'id'], 'like', '%' . $this->keyword . '%');
        }

        if ($this->category) {
            $query->when($this->category, function ($query) {
                return $query->whereHas('categories', function ($q) {
                    $q->where('categories.id', $this->category);
                });
            });
        }

        $supplies = $query->orderByDesc('total')->paginate(10);
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
        $params = array_filter($params, function ($value) {
            return $value !== null && $value !== '';
        });
        return redirect()->route('supplies-pdf', $params);
    }

    public function resetFilter()
    {
        $this->keyword = null;
        $this->category = null;
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
            });
            Toaster::success('Quantity Updated');
            $this->dispatch('quantityValueUpdated');
        } catch (Exception $e) {
            Toaster::error('Something went wrong: ' . $e->getMessage());
        }
    }
}
