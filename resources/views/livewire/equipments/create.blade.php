<x-layouts.create title="Equipment" :cancelLocation="route('equipment.index')" wire:click="submit">
    <x-form.tsselect :options="$officers"
        wire:model.live="officer"
        label="Accounting Officer"
        name="officer" />

    <x-form.tsselect :options="$persons"
        wire:model.live="form.responsible_person_id"
        label="Responsible Person"
        name="form.responsible_person_id" />

    <x-form.select label="Organization Unit"
        :data="$organizations"
        name="form.organization_unit"
        wire:model="form.organization_unit">
    </x-form.select>

    <x-form.select label="Operating Unit Project"
        :data="$operating_units"
        name="form.operating_unit_project"
        wire:model="form.operating_unit_project" />

    <x-form.input label="Property Number"
        name="form.property_number"
        wire:model="form.property_number" />

    <x-form.tsnumber label="Quantity"
        name="form.quantity"
        wire:model.lazy="form.quantity" />

    <x-form.select label="Unit"
        :data="$units"
        name="form.unit"
        wire:model="form.unit" />

    <x-form.input label="Equipment Name"
        name="form.name"
        wire:model="form.name" />

    <x-form.text-area label="Description"
        name="form.description"
        wire:model="form.description"
        :isRequired="false" />

    <x-form.input label="Date Acquired"
        name="form.date_acquired"
        type="date"
        wire:model="form.date_acquired" />

    <x-form.input label="Fund"
        name="form.fund"
        wire:model="form.fund" />

    <x-form.input label="PPE Class"
        name="form.ppe_class"
        wire:model="form.ppe_class" />

    <x-form.date month-year-only wire:model="form.estimated_useful_time" name="form.estimated_useful_time" label="Estimated Useful Time" />

    <x-form.tsnumber label="Unit Price"
        name="form.unit_price"
        wire:model.lazy="form.unit_price" />

    <x-form.tsnumber label="Total Amount"
        name="form.total_amount"
        wire:model="form.total_amount" />
</x-layouts.create>