@if ($paginator->hasPages())
<div class="todo-pagination">
    <div class="pagination-shell">
        <div class="pagination-meta">
            <span class="pagination-meta__label">ページ</span>
            <strong class="pagination-meta__current">{{ $paginator->currentPage() }}</strong>
            <span class="pagination-meta__total">/ {{ $paginator->lastPage() }}</span>
            @if ($paginator->firstItem() !== null)
                <span class="pagination-meta__range">{{ $paginator->firstItem() }}〜{{ $paginator->lastItem() }} / {{ $paginator->total() }}件</span>
            @endif
        </div>

        <nav class="pagination-control" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="page-chip page-chip--arrow page-chip--disabled" aria-disabled="true">
                    <span class="page-chip__icon" aria-hidden="true">‹</span>
                    <span class="sr-only">{{ __('pagination.previous') }}</span>
                </span>
            @else
                <a class="page-chip page-chip--arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <span class="page-chip__icon" aria-hidden="true">‹</span>
                    <span class="sr-only">{{ __('pagination.previous') }}</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="page-chip page-chip--gap">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page-chip page-chip--active" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="page-chip" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="page-chip page-chip--arrow" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <span class="page-chip__icon" aria-hidden="true">›</span>
                    <span class="sr-only">{{ __('pagination.next') }}</span>
                </a>
            @else
                <span class="page-chip page-chip--arrow page-chip--disabled" aria-disabled="true">
                    <span class="page-chip__icon" aria-hidden="true">›</span>
                    <span class="sr-only">{{ __('pagination.next') }}</span>
                </span>
            @endif
        </nav>
    </div>
</div>
@endif
