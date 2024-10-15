<div class="space-y-3">
    <x-plain-heading>{{ ucfirst($equipment->name) }} Details</x-plain-heading>
    <section class="grid grid-cols-2 bg-white rounded-lg shadow-lg p-5 gap-3">
        <x-column-info name="Name" :value="$equipment->name" />
        <x-column-info name="Description" :value="$equipment->description" />
        <x-column-info name="Organization Unit" :value="$equipment->organization_unit" />
        <x-column-info name="Operating Unit/Project" :value="$equipment->operating_unit_project" />
        <x-column-info name="Property Number" :value="$equipment->property_number" />
        <x-column-info name="Quantity" :value="$equipment->quantity" />
        <x-column-info name="Unit" :value="$equipment->unit" />
        <x-column-info name="Date Acquired" :value="$equipment->date_acquired->format('F d, Y')" />
        <x-column-info name="Fund" :value="$equipment->fund" />
        <x-column-info name="PPE Class" :value="$equipment->ppe_class" />
        <x-column-info name="Estimated Useful Time" :value="$equipment->estimated_useful_time" />
        <x-column-info name="Unit Price" :value="$equipment->unit_price" />
        <x-column-info name="Total Amount" :value="$equipment->total_amount" />
        <x-column-info name="Status" :value="$equipment->status" />
        <x-column-info name="Status" :value="$equipment->responsible_person->full_name" />
    </section>
    <div class="pt-3">
        <x-plain-button-link href="/equipments">
            Back
        </x-plain-button-link>
    </div>
</div>