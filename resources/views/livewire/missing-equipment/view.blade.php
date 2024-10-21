<div>
    <x-layouts.view heading="Missing Equipment" backLocation="/missing-equipments">
        <x-span class="col-span-2 text-primary font-bold">About Equipment</x-span>
        <x-column-info name="Equipment" :value="$equipment->equipment->name" />
        <x-column-info name="Equipment Accounting Officer" :value="$equipment->equipment->responsible_person->accounting_officer->full_name" />
        <x-column-info name="Equipment Responsible Person" :value="$equipment->equipment->responsible_person->full_name" />
        <x-column-info name="Quantity" :value="$equipment->equipment->quantity" />
        <x-column-info name="Organization Unit" :value="$equipment->equipment->organization_unit" />
        <x-column-info name="Operating Unit/Project" :value="$equipment->equipment->operating_unit_project" />
        <x-column-info name="PN" :value="$equipment->equipment->property_number" />
        <x-column-info name="Unit" :value="$equipment->equipment->unit" />
        <x-column-info name="Description" :value="$equipment->equipment->description" />
        <x-column-info name="Date Acquired" :value="$equipment->equipment->date_acquired->format('F d, Y')" />
        <x-column-info name="Fund" :value="$equipment->equipment->fund" />
        <x-column-info name="PPE Class" :value="$equipment->equipment->ppe_class" />
        <x-column-info name="Unit Price" :value="$equipment->equipment->unit_price" />

        <x-span class="col-span-2 text-primary font-bold">About Report</x-span>
        <x-column-info name="Quantity Missing" :value="$equipment->quantity" />
        <x-column-info name="Status" :value="$equipment->status" />
        <x-column-info name="Reported By" :value="$equipment->reported_by" />
        <x-column-info name="Reported Date" :value="$equipment->reported_date->format('F d, Y')" />
        <x-column-info name="Descripton" :value="$equipment->description ?? 'N/a'" />
        <x-column-info name="Is Condemned" :value="$equipment->is_condemned ? 'Yes' : 'No'" />

    </x-layouts.view>
</div>