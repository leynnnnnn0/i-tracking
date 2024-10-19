@props(['isRequired' => true, 'label'])
<div class="flex flex-col">
    <span class="text-sm text-gray-700">
        {{$label}}
        @if ($isRequired)
        <span class="text-xs text-red-500">*</span>
        @endif
    </span>
    <x-tsselect.styled select="label:label|value:value" searchable {{ $attributes }} />
</div>