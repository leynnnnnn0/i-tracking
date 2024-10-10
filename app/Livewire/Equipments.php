<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\ActivityLog;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Equipments extends Component
{
    use WithPagination;
    public ActivityLogForm $form;
    public BorrowEquipmentForm $borrowEquipmentForm;
    public $showDeleteModal = false;
    public $query = 'All';
    public $targetId;
    public $equipmentsList;


    public function mount()
    {
        $this->showDeleteModal = false;
    }

    #[On('setTargetId')]
    public function setTargetId($id)
    {
        $this->targetId = $id;
        $this->equipmentsList = Equipment::find($this->targetId)->pluck('name', 'id');
        $this->borrowEquipmentForm->equipment_id = $id;
    }

    public function submit()
    {

        $this->borrowEquipmentForm->store();
        Toaster::success('Successfully Created!');
        $this->dispatch('borrowLogCreated');
    }

    public function updateStatus($id)
    { 
        try {
            DB::transaction(function () use ($id) {
                $log = BorrowedEquipment::orderBy('created_at', 'desc')->where('equipment_id', $id)->first();
                $log->update([
                    'returned_date' => Carbon::today()->format('Y-m-d')
                ]);
                Equipment::find($id)->update([
                    'status' => 'Active'
                ]);
            });
            Toaster::success('Status Updated!');
            $this->dispatch('Status Updated');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function render()
    {
        switch ($this->query) {
            case 'All':
                $equipments = Equipment::with('responsible_person', 'borrowed_log')->latest()->paginate(10);
                break;
            case 'Active':
                $equipments = Equipment::with('responsible_person')->where('status', 'Active')->latest()->paginate(10);
                break;
            case 'Borrowed':
                $equipments = Equipment::with('responsible_person')->where('status', 'Borrowed')->latest()->paginate(10);
                break;
            case 'Condemnd':
                $equipments = Equipment::with('responsible_person')->where('status', 'Condemnd')->latest()->paginate(10);
                break;
        }

        return view('livewire.equipments', [
            'equipments' => $equipments
        ]);
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $equipment = Equipment::findOrFail($id);
                $equipment->delete();
                $this->form->setActivityLog($equipment, null, 'Delete Equipment', 'Delete');
                $this->form->store();
                Toaster::success('Successfully Deleted!');
                $this->dispatch('Data Deleted');
            });
        } catch (Exception $e) {
            Toaster::error('Something Went Wrong!');
        }
    }
}
