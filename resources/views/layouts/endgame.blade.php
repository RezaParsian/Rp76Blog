@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled align-self-center" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="read-more" aria-hidden="true"></span>
                </li>
            @else
                <li class="page-item align-self-center">
                    <a class="read-more" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="align-self-center" aria-disabled="true"><span class="text-white">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="#" data-toggle="tooltip" title="صفحه {{$page}}" class="active disable">
                                {{ sprintf("%02d", $page) }}.
                            </a>
                        @else
                            <a href="{{ $url }}" data-toggle="tooltip" title="صفحه {{$page}}">
                                {{ sprintf("%02d", $page) }}.
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item align-self-center">
                    <a style="transform: rotate(-180deg);" class="read-more" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"></a>
                </li>
            @else
                <li class="page-item disabled align-self-center" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a style="transform: rotate(-180deg);" class="read-more" aria-hidden="true"></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
