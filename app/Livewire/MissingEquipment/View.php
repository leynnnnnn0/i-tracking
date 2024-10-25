<?php

namespace App\Livewire\MissingEquipment;

use App\Models\MissingEquipment;
use Livewire\Component;

class View extends Component
{
    public $equipment;
    public $report_id;

    public function mount($id)
    {
        $this->report_id = $id;
        $this->equipment = MissingEquipment::with('equipment', 'equipment.responsible_person', 'equipment.accounting_officer', 'equipment.organization_unit', 'equipment.fund', 'equipment.personal_protective_equipment', 'equipment.operating_unit_project')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.missing-equipment.view');
    }

    public function downloadPdf()
    {
        return $this->redirect(route('missing-equipment-details-pdf', $this->report_id));
    }
}
