<x-layouts.view heading="Activity Details" backLocation="/activity-logs">

    <div class="col-span-2">
        <p>On {{ $audit->created_at->format('F d, Y')}}, {{ $audit->user->full_name}} {{ $audit->event }} this record. </p>
        <ul>
            @foreach ($this->getModified() as $attribute => $modified)
            <li>@lang('article.'.$audit->event.'.modified.'.$attribute, $modified)</li>
            @endforeach
        </ul>
    </div>

</x-layouts.view>