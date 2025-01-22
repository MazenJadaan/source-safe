<div class="pagination-wrapper">
    @if ($paginator->hasPages())
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link">Previous</a></li>
            @endif

            @foreach ($paginator->links() as $link)
                <li class="page-item {{ $link->active ? 'active' : '' }}">
                    <a href="{{ $link->url }}" class="page-link">{{ $link->label }}</a>
                </li>
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>
    @endif
</div>
