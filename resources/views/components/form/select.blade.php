@props(['label', 'isRequired' => true, 'data' => [], 'name'])
<x-tsselect.styled label="{{ $label }} {{ $isRequired ? '*' : ''}}"
    :options="$data"
    {{$attributes}}>
</x-tsselect.styled>