<?php

namespace App\Livewire\Forms;

use App\Enum\EquipmentStatus;
use App\Enum\MissingStatus;
use App\Exceptions\InsufficientQuantityException;
use App\Models\Equipment;
use App\Models\MissingEquipment;
use Illuminate\Validation\Rule;
use Livewire\Form;

class MissingEquipmentForm extends Form
{
    public $borrowed_equipment_id;
    public $report_id;
    public $equipment_id;
    public $status = 'Reported';
    public $description;
    public $reported_by;
    public $reported_date;
    public $quantity;
    public $is_condemned = false;
    public ActivityLogForm $activityLogForm;

    public function setMissingEquipmentForm(MissingEquipment $missingEquipment)
    {
        $this->borrowed_equipment_id = $missingEquipment->borrowed_equipment_id;
        $this->report_id = $missingEquipment->id;
        $this->equipment_id = $missingEquipment->equipment_id;
        $this->status = $missingEquipment->status;
        $this->quantity = $missingEquipment->quantity;
        $this->description = $missingEquipment->description;
        $this->reported_by = $missingEquipment->reported_by;
        $this->reported_date = $missingEquipment->reported_date->format('Y-m-d');
        $this->is_condemned = $missingEquipment->is_condemned;
    }
    public function rules()
    {
        return [
            'borrowed_equipment_id' => ['sometimes', 'nullable', 'exists:borrowed_equipment,id'],
            'equipment_id' => ['required', 'exists:equipment,id'],
            'status' => ['required', 'string', Rule::in(MissingStatus::values())],
            'quantity' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $equipment = Equipment::find($this->equipment_id);
                    if ($equipment) {
                        if ($value > $equipment->quantity) {
                            $fail("The {$attribute} must not exceed the equipment's total quantity of {$equipment->quantity}.");
                        }
                    } else {
                        $fail("Unable to verify equipment quantity. Please ensure a valid equipment is selected.");
                    }
                },
            ],
            'description' => ['nullable', 'string', 'max:255'],
            'reported_by' => ['required', 'string', 'max:100'],
            'reported_date' => ['required', 'date', 'before_or_equal:today'],
            'is_condemned' => ['sometimes', 'required', 'boolean']
        ];
    }
    public function store()
    {
        $missingEquipment =  MissingEquipment::create($this->all());
        $equipment = $missingEquipment->equipment;
        $missingEquipmentQuantity = $equipment->quantity_missing + $missingEquipment->quantity;
        $equipmentQuantityAvailable = $equipment->quantity_available - $missingEquipmentQuantity;
        $equipment->update([
            'quantity_available' => $equipmentQuantityAvailable,
            'quantity_missing' => $missingEquipmentQuantity,
        ]);
        return $missingEquipment;
    }

    public function update(MissingEquipment $missingEquipment)
    {
        $missingEquipment->update($this->all());
        return $missingEquipment->fresh();
    }

    public function condemned($equipment_id)
    {
        $equipment = Equipment::findOrFail($equipment_id);
        $totalQuantityMissing = $equipment->quantity_missing - $this->quantity;
        $totalQuantityCondemned = $equipment->quantity_condemned + $this->quantity;
        $equipment->update([
            'quantity_missing' => $totalQuantityMissing,
            'quantity_condemned' => $totalQuantityCondemned
        ]);
        
        // $equipmentQuantityLeft = (int) $equipment->quantity - (int) $this->quantity;
        // if ($equipmentQuantityLeft < 0) {
        //     throw new InsufficientQuantityException();
        // }
        // $equipment->update([
        //     'quantity' => (int) $equipment->quantity - (int) $this->quantity,
        // ]);
    }
}
