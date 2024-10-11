@props(['data' => []])
<select {{ $attributes }} class="rounded-lg border-gray-300">
    {{ $slot }}
    @foreach ($data as $key => $value)
    <option value="{{ $key }}">{{$value}}</option>
    @endforeach
</select>