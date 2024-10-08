<?php

namespace App\Livewire;

use App\Models\Equipment;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toast;
use Masmerise\Toaster\Toaster;

class Equipments extends Component
{
    use WithPagination;
    public $showDeleteModal = false;
    public $query = 'All';

    public function mount()
    {
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
            case 'Available':
                $equipments = Equipment::where('is_borrowed', false)->latest()->paginate(10);
                break;
            case 'Borrowed':
                $equipments = Equipment::where('is_borrowed', true)->latest()->paginate(10);
                break;
        }

        return view('livewire.equipments', [
            'equipments' => $equipments
        ]);
    }

    public function delete($id)
    {
        Equipment::findOrFail($id)->delete();
        Toaster::success('Successfully Deleted!');
        $this->dispatch('Data Deleted');
    }
}
