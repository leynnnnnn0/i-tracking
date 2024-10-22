@props(['isRequired' => true, 'label'])
<x-tsselect.styled select="label:label|value:value" searchable {{ $attributes }} label="{{ $label }} {{ $isRequired ? '*' : ''}}" />