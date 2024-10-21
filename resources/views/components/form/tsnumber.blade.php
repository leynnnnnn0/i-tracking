@props(['label', 'type' => 'text', 'isRequired' => true])
<x-tsnumber onkeydown="return event.keyCode !== 69" {{ $attributes }} class="rounded-lg border-gray-300" label="{{ $label }} {{ $isRequired ? '*' : ''}}" />