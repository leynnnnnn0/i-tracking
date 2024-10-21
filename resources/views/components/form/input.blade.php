@props(['label', 'isRequired' => true])
<x-tsinput {{ $attributes }} class="rounded-lg border-gray-300" label="{{ $label }} {{ $isRequired ? '*' : ''}}" />