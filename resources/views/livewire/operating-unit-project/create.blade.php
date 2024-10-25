<x-layouts.create title="Operating Unit" :cancelLocation="route('operating-units.index')" wire:click="submit">
    <x-form.input label="Name"
        name="form.name"
        wire:model="form.name" />
</x-layouts.create>