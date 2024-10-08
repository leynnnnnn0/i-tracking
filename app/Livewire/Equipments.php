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

    public function mount()
    {
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.equipments', [
            'equipments' => Equipment::with('responsible_person', 'borrowed_log')->latest()->paginate(10)
        ]);
    }

    public function delete($id)
    {
        Equipment::findOrFail($id)->delete();
        Toaster::success('Successfully Deleted!');
        $this->dispatch('Data Deleted');
    }
}
