<x-layouts.view heading="Missing Equipment" backLocation="/missing-equipments">
    <x-column-info name="Equipment" :value="$equipment->equipment->name"/>
    <x-column-info name="Equipment Accounting Officer" :value="$equipment->equipment->responsible_person->accounting_officer->full_name"/>
    <x-column-info name="Equipment Accounting Officer" :value="$equipment->equipment->responsible_person->full_name"/>
    <x-column-info name="PN" :value="$equipment->equipment->property_number"/>
</x-layouts.view>