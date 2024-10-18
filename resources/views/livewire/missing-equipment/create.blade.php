<div>
    <section class="space-y-3">
        <x-plain-heading>Make A Report</x-plain-heading>

        <div class="bg-white rounded-xl p-5">
            <section class="pb-5 border-b border-gray-300">
                <h1 class="text-gray-700 font-bold text-lg">Report Information</h1>
                <p class="text-gray-600 text-xs">Please input all the required fields.</p>
            </section>
            <section class="py-2 grid grid-cols-2 gap-5">
                <x-form.select label="Equipment" :data="$equipments" name="form.equipment_id" wire:model="form.equipment_id" />
                <x-form.select label="Status" :data="$statuses" name="form.status" wire:model.live="form.status" />
                <x-form.input label="Reported By" name="form.reported_by" wire:model="form.reported_by" />
                <x-form.input label="Reported Date" name="form.reported_date" type="date" wire:model="form.reported_date" />
                <x-form.text-area label="Description" name="form.description" wire:model="form.description" :isRequired="false" />

                @if($form->status === 'Reported to SPMO')
                <div class="flex gap-1 flex-col">
                    <label class="text-sm text-gray-700">Is Condemened? <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-3 h-full">
                        <div class="flex items-center gap-1">
                            <label class="text-sm text-gray-700">Yes</label>
                            <input wire:model="isCondemened" value="1" type="radio" name="isCondemened">
                        </div>
                        <div class="flex items-center gap-1">
                            <label class="text-sm text-gray-700">No</label>
                            <input wire:model="isCondemened" value="0" type="radio" name="isCondemened">
                        </div>
                    </div>
                </div>
                @endif
            </section>
            <section class="flex justify-end gap-3">
                <a href="/missing-equipments" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
                <x-primary-button wire:click="submit">Submit</x-primary-button>
            </section>
        </div>
    </section>

</div>