<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\Category as ModelsCategory;
use App\Models\Office;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Category extends Component
{
    use WithPagination;
    public ActivityLogForm $activityLogForm;
    
    public function render()
    {
        return view('livewire.category', [
            'categories' => ModelsCategory::paginate(10)
        ]);
    }

    public function downloadPdf()
    {
        return redirect()->route('categories-pdf');
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $category = ModelsCategory::findOrFail($id);
                $category->delete();
                $this->activityLogForm->setActivityLog($category, null, 'Deleted Category', 'Delete');
                $this->activityLogForm->store();
            });
            Toaster::success('Deleted Successfully');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
