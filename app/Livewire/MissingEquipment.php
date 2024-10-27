<?php

namespace App\Livewire;

use App\Exceptions\InsufficientQuantityException;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\MissingEquipment as ModelsMissingEquipment;
use App\Traits\Deletable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use TallStackUi\Traits\Interactions;

class MissingEquipment extends Component
{
    use WithPagination, Deletable, Interactions;
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

    public function resetFilter()
    {
        $this->keyword = null;
        $this->query = 'All';
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
        $params = [
            'filter'=> $this->query,
            'keyword' => $this->keyword
        ];
        return redirect()->route('missing-equipment-reports-pdf', $params);
    }

    public function changeStatus($reportId)
    {
        try {
            DB::transaction(function () use ($reportId) {
                $model = ModelsMissingEquipment::findOrFail($reportId);
                $equipment = $model->equipment;
                if ($model->status === 'Reported to SPMO') {
                    $model->update([
                        'is_condemned' => true,
                    ]);
                    $this->form->setMissingEquipmentForm($model);
                    $this->form->condemned($model->equipment_id);
                }
                if ($model->status === 'Reported') {
                    $model->update([
                        'status' => 'Reported to SPMO',
                    ]);
                }
            });
            Toaster::success('Updated Successfully');
        } catch (InsufficientQuantityException $ie) {
            $this->dialog()->error(
                'Missing Quantity Exceeds the Equipment Quantity',
                'The quantity you are trying to process is greater than the available stock.'
            )->send();
        } catch (Exception $e) {
            dd($e);
        } finally {
            $this->dispatch('Condemned');
        }
    }
}
