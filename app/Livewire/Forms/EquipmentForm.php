<?php

namespace App\Livewire\Forms;

use App\Enum\EquipmentStatus;
use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Form;

class EquipmentForm extends Form
{
    public $equipment_id;
    public $personnel_id;
    public $accounting_officer_id;
    public $fund_id;
    public $personal_protective_equipment_id;
    public $organization_unit_id;
    public $operating_unit_project_id;
    public $property_number;
    public $quantity;
    public $quantity_available;
    public $quantity_borrowed = 0;
    public $quantity_missing = 0;
    public $quantity_condemned = 0;
    public $unit;
    public $name;
    public $description;
    public $date_acquired;
    public $estimated_useful_time;
    public $unit_price;
    public $total_amount;
    public $status = 'active';

    public function rules()
    {
        return [
            'personnel_id' => ['required', 'exists:personnel,id'],
            'accounting_officer_id' => ['required', 'exists:accounting_officers,id'],
            'organization_unit_id' => ['required', 'exists:organization_units,id'],
            'operating_unit_project_id' => ['required', 'exists:operating_unit_projects,id'],
            'fund_id' => ['required', 'exists:funds,id'],
            'personal_protective_equipment_id' => ['required', 'exists:personal_protective_equipment,id'],
            'property_number' => ['required', Rule::unique('equipment')->ignore($this->equipment_id)],
            'quantity' => ['required', 'integer', 'min:0'],
            'quantity_avaiable' => ['required', 'integer', 'min:0'],
            'quantity_missing' => ['nullable', 'integer', 'min:0'],
            'quantity_borrowed' => ['nullable', 'integer', 'min:0'],
            'quantity_condemned' => ['nullable', 'integer', 'min:0'],
            'unit' => ['required', 'string', 'min:1'],
            'name' => ['required', 'min:2'],
            'description' => ['nullable', 'string'],
            'date_acquired' => ['required', 'date', 'before_or_equal:' . Carbon::today()],
            'estimated_useful_time' => ['nullable', 'after:date_acquired'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', Rule::enum(EquipmentStatus::class)],
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
        $this->personnel_id = $equipment->personnel_id;
        $this->accounting_officer_id = $equipment->accounting_officer_id;
        $this->operating_unit_project_id = $equipment->operating_unit_project_id;
        $this->organization_unit_id = $equipment->organization_unit_id;
        $this->personal_protective_equipment_id = $equipment->personal_protective_equipment_id;
        $this->fund_id = $equipment->fund_id;
        $this->property_number = $equipment->property_number;
        $this->quantity = $equipment->quantity;
        $this->unit = $equipment->unit;
        $this->name = $equipment->name;
        $this->description = $equipment->description;
        $this->date_acquired = $equipment->date_acquired->format('Y-m-d');
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
        $equipment->update($this->all());
        return $equipment->fresh();
    }
}
