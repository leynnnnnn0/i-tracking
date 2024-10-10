<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\ActivityLog;
use App\Models\Equipment;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Equipments extends Component
{
    use WithPagination;
    public ActivityLogForm $form;
    public $showDeleteModal = false;
    public $query = 'All';
    public $equipment;

    public function mount()
    {
        $this->equipment = Equipment::findOrFail(1);
        $this->showDeleteModal = false;
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
