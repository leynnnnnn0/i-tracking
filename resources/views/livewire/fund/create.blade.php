<x-layouts.create title="Fund" :cancelLocation="route('funds.index')" wire:click="submit">
    <x-form.input label="Name"
        name="form.name"
        wire:model="form.name" />
</x-layouts.create>