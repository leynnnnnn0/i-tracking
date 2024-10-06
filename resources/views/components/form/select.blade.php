@props(['label', 'isRequired' => true, 'data' => [], 'name'])
<div class="flex flex-col gap-1">
    <label class="text-sm text-gray-700">{{ $label }}
        @if ($isRequired)
        <span class="text-red-500">*</span>
        @endif
    </label>
    <select {{ $attributes }} class="rounded-lg border-gray-300">
        <option value="">Select from options</option>
        @foreach ($data as $key => $value)
        <option value="{{ $key }}">{{$value}}</option>
        @endforeach
    </select>
    <x-form.error :name="$name" />
</div>