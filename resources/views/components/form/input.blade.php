@props(['label', 'type' => 'text', 'isRequired' => true, 'name'])
<div class="flex flex-col gap-1">
    <label class="text-sm text-gray-700">{{ $label }}
        @if ($isRequired)
        <span class="text-red-500">*</span>
        @endif
    </label>
    <x-tsinput {{ $attributes }} type="{{ $type }}" class="rounded-lg border-gray-300" invalidate />
    <x-form.error :name="$name" />
</div>