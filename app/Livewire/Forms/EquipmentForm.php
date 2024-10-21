<?php

namespace App\Livewire\Forms;

use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Validation\Rule;
use Livewire\Form;

class EquipmentForm extends Form
{
    public $equipment_id;
    public $responsible_person_id;
    public $organization_unit;
    public $operating_unit_project;
    public $property_number;
    public $quantity;
    public $unit;
    public $name;
    public $description;
    public $date_acquired;
    public $fund;
    public $ppe_class;
    public $estimated_useful_time;
    public $unit_price;
    public $total_amount;
    public $status = 'Active';

    public function rules()
    {
        return [
            'responsible_person_id' => ['required', 'exists:responsible_people,id'],
            'organization_unit' => ['required'],
            'operating_unit_project' => ['required', 'string'],
            'property_number' => ['required', Rule::unique('equipment')->ignore($this->equipment_id)],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit' => ['required', 'string', 'min:1'],
            'name' => ['required', 'min:2'],
            'description' => ['nullable', 'string'],
            'date_acquired' => ['required', 'date', 'before_or_equal:' . Carbon::today()],
            'fund' => ['nullable', 'string'],
            'ppe_class' => ['nullable', 'string'],
            'estimated_useful_time' => ['nullable', 'after:date_acquired'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'date_acquired.before_or_equal' => 'Acquired date can\'t be greater than today',
            'estimated_useful_time' => 'Estimated useful time can\'t be before or equals today'
        ];
    }
    public function setEquipment(Equipment $equipment)
    {
        $this->equipment_id = $equipment->id;
        $this->responsible_person_id = $equipment->responsible_person_id;
        $this->organization_unit = $equipment->organization_unit;
        $this->operating_unit_project = $equipment->operating_unit_project;
        $this->property_number = $equipment->property_number;
        $this->quantity = $equipment->quantity;
        $this->unit = $equipment->unit;
        $this->name = $equipment->name;
        $this->description = $equipment->description;
        $this->date_acquired = $equipment->date_acquired->format('Y-m-d');
        $this->fund = $equipment->fund;
        $this->ppe_class = $equipment->ppe_class;
        $this->estimated_useful_time = $equipment->estimated_useful_time;
        $this->unit_price = $equipment->unit_price;
        $this->total_amount = $equipment->total_amount;
        $this->status = $equipment->status;
    }


    public function store()
    {
        return Equipment::create($this->all());
    }

    public function update(Equipment $equipment)
    {
        $this->equipment_id = $equipment->id;
        $this->validate();
        $equipment->update($this->all());
        return $equipment->fresh();
    }
}
