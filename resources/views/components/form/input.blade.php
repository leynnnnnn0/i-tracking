@props(['label', 'type' => 'text', 'isRequired' => false, 'name'])
<div class="flex flex-col gap-1">
    <label class="text-sm text-gray-700">{{ $label }}
        @if ($isRequired)
        <span class="text-red-500">*</span>
        @endif
    </label>
    <input {{ $attributes }} type="{{ $type }}" class="rounded-lg border-gray-300">
    <x-form.error :name="$name" />
</div>