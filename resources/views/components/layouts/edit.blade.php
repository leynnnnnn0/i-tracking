@props(['title', 'cancelLocation'])
<div x-data="{
     showConfirmationModal: false,
     openConfirmationModal() {
            this.showConfirmationModal = true;
            Livewire.on('Confirm Update', () => {
            this.showConfirmationModal = false;
            })
        },
    }">
    <x-plain-heading class="mb-3">Edit {{ $title }} Details</x-plain-heading>
    <div class="bg-white rounded-xl p-5 dark:bg-secondary-dark">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg dark:text-white">{{ $title }} Details</h1>
            <p class="text-gray-600 text-xs dark:text-white">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            {{ $slot }}
        </section>
        <section class="flex justify-end gap-3">
            <x-link href="{{ $cancelLocation }}" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300 dark:text-white dark:border-white">Cancel</x-link>
            <x-primary-button @click="openConfirmationModal">Update</x-primary-button>
        </section>
    </div>

    <!-- Modal -->
    <template x-if="showConfirmationModal">
        <x-confirmation-modal message="Are you sure you want to update the {{ strtolower($title) }} details?" {{ $attributes}} />
    </template>

</div>