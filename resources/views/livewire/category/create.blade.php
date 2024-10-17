<div class="space-y-4">
    <h1 class="font-bold text-2xl text-emerald-900">Create New Category</h1>
    <div class="bg-white rounded-xl p-5">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">Category Form</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            <x-form.input label="Name"
                name="form.name"
                wire:model="form.name" />
        </section>
        <section class="flex justify-end gap-3">
            <a href="/categories" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
            <x-primary-button wire:click="submit">Submit</x-primary-button>
        </section>
    </div>
</div>