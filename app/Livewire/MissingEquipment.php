<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\MissingEquipment as ModelsMissingEquipment;
use App\Traits\Deletable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class MissingEquipment extends Component
{
    use WithPagination, Deletable;
    public $query = 'All';
    public ActivityLogForm $activityLogForm;
    public MissingEquipmentForm $form;
    public $keyword;
    public function updatedKeyword()
    {
        $this->resetPage();
    }

    protected function getModel(): string
    {
        return ModelsMissingEquipment::class;
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }
    public function render()
    {
        $query = ModelsMissingEquipment::query()->with('equipment');
        if ($this->query !== 'All') {
            if ($this->query === 'Condemned') {
                $query->where('is_condemned', true);
            } else {
                $query->where('status', $this->query);
            }
        }

        if ($this->keyword) {
            $query->whereAny(['id'], 'like', "%$this->keyword%")
                ->orWhereHas('equipment', function ($q) {
                    $q->where('name', 'like', "%$this->keyword%");
                });
        }

        $data = $query->latest()->paginate(10);
        return view('livewire.missing-equipment', [
            'data' => $data
        ]);
    }

    public function downloadPdf()
    {
        return redirect()->route('missing-equipments-pdf');
    }

    public function changeStatus($reportId)
    {
        try {
            DB::transaction(function () use ($reportId) {
                $before = ModelsMissingEquipment::findOrFail($reportId);
                if ($before->status === 'Reported to SPMO') {
                    $before->update([
                        'is_condemned' => true,
                    ]);
                    $this->form->setMissingEquipmentForm($before);
                    $this->form->condemned($before->equipment_id);
                }
                if ($before->status === 'Reported') {
                    $before->update([
                        'status' => 'Reported to SPMO',
                    ]);
                }
                $after = $before->fresh();
                $this->activityLogForm->setActivityLog($before, $after, 'Tag Missing Equipment as ' . $after->status, 'Update');
                $this->activityLogForm->store();
            });
            $this->dispatch('Condemned');
            Toaster::success('Updated Successfully');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
