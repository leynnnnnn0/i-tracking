<x-layouts.edit title="Equipment" cancelLocation="/equipment" wire:click="update">
    <x-form.tsselect :options="$officers"
        wire:model="form.accounting_officer_id"
        label="Accounting Officer"
        name="form.accounting_officer_id" />

    <x-form.tsselect :options="$persons"
        wire:model="form.personnel_id"
        label="Responsible Person"
        name="form.personnel_id" />

    <x-form.select label="Organization Unit"
        :options="$organizations"
        name="form.organization_unit_id"
        wire:model="form.organization_unit_id">
    </x-form.select>

    <x-form.select label="Operating Unit Project"
        :options="$operating_units"
        name="form.operating_unit_project_id"
        wire:model="form.operating_unit_project_id">
    </x-form.select>

    <x-form.select label="Fund"
        :options="$funds"
        name="form.fund_id"
        wire:model="form.fund_id" />

    <x-form.select label="PPE"
        :options="$personalProtectiveEquipment"
        name="form.personal_protective_equipment_id"
        wire:model="form.personal_protective_equipment_id" />

    <x-form.input label="Property Number"
        name="form.property_number"
        wire:model="form.property_number" />

    <x-form.tsnumber label="Quantity"
        name="form.quantity"
        wire:model.lazy="form.quantity" />

    <x-form.select label="Unit"
        :options="$units"
        name="form.unit"
        wire:model="form.unit" />

    <x-form.input label="Equipment Name"
        name="form.name"
        wire:model="form.name" />

    <x-form.text-area label="Description"
        name="form.description"
        wire:model="form.description"
        :isRequired="false" />

    <x-form.date label="Date Acquired"
        name="form.date_acquired"
        wire:model="form.date_acquired" />

    <x-tsdate :isRequired="false" month-year-only wire:model="form.estimated_useful_time" name="form.estimated_useful_time" label="Estimated Useful Time" />

    <x-form.tsnumber label="Unit Price"
        name="form.unit_price"
        wire:model.lazy="form.unit_price" />

    <x-form.tsnumber label="Total Amount"
        name="form.total_amount"
        wire:model="form.total_amount" />
</x-layouts.edit>