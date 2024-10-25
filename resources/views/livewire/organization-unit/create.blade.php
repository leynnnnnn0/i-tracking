<x-layouts.create title="Organization Unit" :cancelLocation="route('organization-units.index')" wire:click="submit">
    <x-form.input label="Name"
        name="form.name"
        wire:model="form.name" />
</x-layouts.create>
