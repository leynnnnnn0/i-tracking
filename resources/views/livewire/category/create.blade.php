<x-layouts.create title="Category" :cancelLocation="route('categories.index')" wire:click="submit">
    <x-form.input label="Name"
        name="form.name"
        wire:model="form.name" />
</x-layouts.create>