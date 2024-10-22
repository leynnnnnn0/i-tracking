<x-layouts.create title="Office" :cancelLocation="route('offices.index')" wire:click="submit">
    <x-form.input label="Name"
        name="form.name"
        wire:model="form.name" />
</x-layouts.create>