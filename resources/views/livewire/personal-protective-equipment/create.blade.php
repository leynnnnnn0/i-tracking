<x-layouts.create title="Personal Protective Equipment" :cancelLocation="route('personal-protective-equipment.index')" wire:click="submit">
    <x-form.input label="Name"
        name="form.name"
        wire:model="form.name" />
</x-layouts.create>