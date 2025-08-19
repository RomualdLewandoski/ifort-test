@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span class="pagination-link disabled" aria-disabled="true">« Précédent</span>
        @else
            <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">« Précédent</a>
        @endif

        @php
            $start = max(1, $paginator->currentPage() - 2);
            $end   = min($paginator->lastPage(), $paginator->currentPage() + 2);
        @endphp

        @if ($start > 1)
            <a class="pagination-link" href="{{ $paginator->url(1) }}">1</a>
            @if ($start > 2) <span class="pagination-ellipsis">…</span> @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            @if ($i === $paginator->currentPage())
                <span class="pagination-link active" aria-current="page">{{ $i }}</span>
            @else
                <a class="pagination-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            @endif
        @endfor

        @if ($end < $paginator->lastPage())
            @if ($end < $paginator->lastPage() - 1) <span class="pagination-ellipsis">…</span> @endif
            <a class="pagination-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
        @endif

        @if ($paginator->hasMorePages())
            <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant »</a>
        @else
            <span class="pagination-link disabled" aria-disabled="true">Suivant »</span>
        @endif
    </nav>
@endif
