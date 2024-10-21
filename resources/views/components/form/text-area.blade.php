@props(['label', 'isRequired' => true])
<x-tstextarea label="{{ $label }} {{ $isRequired ? '*' : ''}}" {{ $attributes }} />