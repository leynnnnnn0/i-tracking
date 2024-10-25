<div>
    <ul>
        @foreach ($audits as $audit)
        <li>

            @foreach ($audit->getModified() as $attribute => $modified)
        <li>{{ $attribute }}</li> {{ var_dump($modified)}}
        @endforeach

        @endforeach
        </li>
    </ul>
</div>