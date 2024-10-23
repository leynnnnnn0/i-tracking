<x-layouts.create title="Department" :cancelLocation="route('departments.index')" wire:click="submit">
    <x-form.input label="Name"
        name="form.name"
        wire:model="form.name" />
</x-layouts.create>