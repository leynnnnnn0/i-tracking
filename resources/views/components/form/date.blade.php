@props(['label', 'isRequired' => true, 'name'])
<div class="flex flex-col gap-1">
    <label class="text-sm text-gray-700">{{ $label }}
        @if ($isRequired)
        <span class="text-red-500">*</span>
        @endif
    </label>
    <x-tsdate {{ $attributes }} class="rounded-lg border-gray-300" invalidate />
    <x-form.error :name="$name" />
</div>