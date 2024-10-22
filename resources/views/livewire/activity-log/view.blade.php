<x-layouts.view heading="Action" backLocation="/activity-logs">
    <x-column-info name="User" :value="$log->user->full_name" />
    <x-column-info name="Action" :value="$log->action_type" />
    <x-column-info name="Model Id" :value="$log->model_id" />
    <x-column-info name="Description" :value="$log->description" />
    <x-column-info name="Data and Time of Action" :value="$log->created_at->format('F d, Y H:i a')" />
    <h1 class="text-primary font-bold text-sm col-span-2">Data before action taken</h1>
    @if ($log->before_data)
    @foreach ($log->before_data as $key => $value)
    @if (!is_array($value))
    <x-column-info :name="Str::title(Str::replace('_', ' ', $key))" :value="$value" />
    @endif
    @endforeach
    @else
    <h1 class="text-sm col-span-2">None</h1>
    @endif

    <h1 class="text-primary font-bold text-sm col-span-2">Data after action taken</h1>
    @if ($log->after_data)
    @foreach ($log->after_data as $key => $value)
    @if (!is_array($value))
    <x-column-info :name="Str::title(Str::replace('_', ' ', $key))" :value="$value" />
    @endif
    @endforeach
    @endif

</x-layouts.view>