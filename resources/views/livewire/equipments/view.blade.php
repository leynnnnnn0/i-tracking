<x-layouts.view heading="{{ ucfirst($equipment->name) }}" backLocation="/equipment">
    <x-column-info name="Equipment Id"
        :value="$equipment->id" />
    <x-column-info name="Name"
        :value="$equipment->name" />
    <x-column-info name="Description"
        :value="$equipment->description" />
    <x-column-info name="Organization Unit"
        :value="$equipment->organization_unit->name" />
    <x-column-info name="Operating Unit/Project"
        :value="$equipment->operating_unit_project->name" />
    <x-column-info name="Fund"
        :value="$equipment->fund->name" />
    <x-column-info name="PPE Class"
        :value="$equipment->personal_protective_equipment->name" />
    <x-column-info name="Property Number"
        :value="$equipment->property_number" />
    <x-column-info name="Quantity"
        :value="$equipment->quantity($query)" />
    <x-column-info name="Unit"
        :value="$equipment->unit" />
    <x-column-info name="Date Acquired"
        :value="$equipment->date_acquired->format('F d, Y')" />
    <x-column-info
        name="Estimated Useful Time"
        :value="'until ' . \Carbon\Carbon::parse($equipment->estimated_useful_time)->format('F Y')" />
    <x-column-info name="Unit Price"
        :value="$equipment->unit_price" />
    <x-column-info name="Total Amount"
        :value="$equipment->total_amount" />
    <x-column-info name="Status"
        :value="$query === 'Condemned' ? $query : Str::headline($equipment->status->value)" />
    <x-column-info name="Responsible Person"
        :value="$equipment->personnel->full_name" />
    <x-column-info name="Accounting Officer"
        :value="$equipment->accounting_officer->full_name" />
</x-layouts.view>