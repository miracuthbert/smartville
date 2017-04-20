<div class="btn-group btn-group-sm">
    <button type="button" class="btn btn-default dropdown-toggle"
            data-toggle="dropdown" aria-expanded="false">
        Pages
        <i class="caret"></i>
    </button>
    <ul class="dropdown-menu pull-right">
        <li>
            <a href="{{ route('manpage.create', ['manchapter' => $chapter->id]) }}">
                Add New
            </a>
        </li>
        <li role="separator" class="divider"></li>
        <li class="dropdown-header">Pages</li>
        @forelse($chapter->pages as $page)
            <li>
                <a href="{{ route('manpage.edit', ['manpage' => $page->id]) }}">
                    {{ $page->title }}
                </a>
            </li>
        @empty
            <li class="text-center">No pages found</li>
        @endforelse
        <li role="separator" class="divider"></li>
        <li>
            <a href="{{ route('manpage.index', ['manchapter' => $manual->id]) }}">
                View All
            </a>
        </li>
    </ul>
</div>
<!-- manual pages options -->
