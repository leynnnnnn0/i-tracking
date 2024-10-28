<x-layouts.view heading="Activity" backLocation="/activity-logs">

    <div class="col-span-2">
        <p>On {{ $audit->created_at->format('F d, Y H:i:s a')}}, {{ $audit->user->full_name}} {{ $audit->event }} this {{Str::headline( Str::snake(Str::after($audit->auditable_type,'Models\\'), ' ')) }} ID#{{ $audit->auditable_id}}</p>
        <ul>
            @foreach ($this->getModified() as $attribute => $modified)
            <li>@lang('article.'.$audit->event.'.modified.'.$attribute, $modified)</li>
            @endforeach
        </ul>
    </div>

</x-layouts.view>