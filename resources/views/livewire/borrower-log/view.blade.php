<x-layouts.view heading="Borrowed Equipment" backLocation="/borrowed-logs">
    <x-column-info name="Equipment" :value="$borrowedEquipment->equipment->name" />
    <x-column-info name="Borrower" :value="$borrowedEquipment->full_name" />
    <x-column-info name="Phone Number" :value="$borrowedEquipment->borrower_phone_number" />
    <x-column-info name="Email" :value="$borrowedEquipment->borrower_email" />
    <x-column-info name="Start Date" :value="$borrowedEquipment->start_date->format('M d, Y')" />
    <x-column-info name="End Date" :value="$borrowedEquipment->end_date->format('M d, Y')" />
    <x-column-info name="Returned Date" :value="$borrowedEquipment->returned_date ? $borrowedEquipment->returned_date->format('M d, Y') : 'Not yet returned'" />
</x-layouts.view>
