<div class="btn-group btn-group-sm">
    <button type="button" class="btn btn-default dropdown-toggle"
            data-toggle="dropdown" aria-expanded="false">
        Chapters...
        <i class="caret"></i>
    </button>
    <ul class="dropdown-menu pull-right">
        <li>
            <a href="{{ route('manchapter.create', ['manual' => $manual->id]) }}">
                Add New
            </a>
        </li>
        <li role="separator" class="divider"></li>
        <li class="dropdown-header">Chapters</li>
        @forelse($chapters as $chapter)
            <li>
                <a href="{{ route('manchapter.edit', ['manchapter' => $chapter->id]) }}">
                    {{ $chapter->title }}
                </a>
            </li>
        @empty
            <li class="text-center">No chapters found</li>
        @endforelse
        <li role="separator" class="divider"></li>
        <li>
            <a href="{{ route('manchapter.index', ['manual' => $manual->id]) }}">
                View All
            </a>
        </li>
    </ul>
</div>
