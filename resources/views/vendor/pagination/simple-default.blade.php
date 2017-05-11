@if ($paginator->hasPages())
    <ul class="pager">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&leftarrow; Prev.</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&leftarrow; Prev.</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&rightarrow; Next</a></li>
        @else
            <li class="disabled"><span>&rightarrow; Next</span></li>
        @endif
    </ul>
@endif
