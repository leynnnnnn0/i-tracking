@props(['label', 'isRequired' => true])
<x-tsdate {{ $attributes }} class="rounded-lg border-gray-300" label="{{ $label }} {{ $isRequired ? '*' : ''}}" />