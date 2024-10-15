<div>
    <div class="space-y-3">
        <x-plain-heading>Dashboard</x-plain-heading>
        <section class="flex items-center justify-between gap-2">
            <x-stats-container>
                <x-ri-tools-fill class="size-10 text-white" />
                <div class="flex flex-col gap-2">
                    <h1 class="text-white font-bold text-lg">Available Equipments</h1>
                    <span class="text-white font-bold text-2xl text-center">{{ $availableEquipments ?? 0 }}</span>
                </div>
            </x-stats-container>
            <x-stats-container>
                <x-bi-pass class="size-10 text-white" />
                <div class="flex flex-col gap-2">
                    <h1 class="text-white font-bold text-lg">Borrowed Equipments</h1>
                    <span class="text-white font-bold text-2xl text-center">{{ $borrowedEquipments ?? 0 }}</span>
                </div>
            </x-stats-container>
            <x-stats-container>
                <x-ri-group-line class="size-10 text-white" />
                <div class="flex flex-col gap-2">
                    <h1 class="text-white font-bold text-lg">Personnels</h1>
                    <span class="text-white font-bold text-2xl text-center">{{ $personnels ?? 0 }}</span>
                </div>
            </x-stats-container>
            <x-stats-container>
                <x-bi-question-circle class="size-10 text-white" />
                <div class="flex flex-col gap-2">
                    <h1 class="text-white font-bold text-lg">Missing Equipments</h1>
                    <span class="text-white font-bold text-2xl text-center">{{ $missingEquipments}}</span>
                </div>
            </x-stats-container>
        </section>
    </div>
</div>