<?php

namespace App\Livewire;

use App\Helper\ColorStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\SupplyForm;
use App\Models\Supply as ModelsSupply;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Supply extends Component
{
    use WithPagination;
    public ActivityLogForm $activityLogForm;
    public SupplyForm $form;

    public function render()
    {
        return view('livewire.supply', [
            'data' => ModelsSupply::latest()->paginate(10)
        ]);
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

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $supply = ModelsSupply::findOrFail($id);
                $supply->delete();
                $this->activityLogForm->setActivityLog(
                    $supply,
                    null,
                    'Delete Supply',
                    'Delete'
                );
                $this->activityLogForm->store();
            });
            Toaster::success('Successfully Deleted!');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            dd($e);
            Toaster::error('Something went wrong: ' . $e->getMessage());
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
