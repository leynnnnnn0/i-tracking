<x-layouts.create title="Position" :cancelLocation="route('positions.index')" wire:click="submit">
    <x-form.input label="Name"
        name="form.name"
        wire:model="form.name" />
</x-layouts.create>