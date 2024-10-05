@props(['name'])
<div>
    @error($name) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>