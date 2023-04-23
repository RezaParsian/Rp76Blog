@if ($paginator->hasPages())
    <nav>
        <ul class="flex space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled my-auto" aria-disabled="true">
                    <span class="text-gray-400" aria-hidden="true">
                        <x-svg.backward class="scale-150 fill-slate-300 hover:fill-slate-300"></x-svg.backward>
                    </span>
                </li>
            @else
                <li class="my-auto">
                    <a href="{{ $paginator->previousPageUrl() }}" class="my-auto" rel="prev" aria-label="@lang('pagination.previous')">
                        <x-svg.backward class="scale-150"></x-svg.backward>
                    </a>
                </li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="text-slate-500">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="#" data-toggle="tooltip" title="صفحه {{$page}}" class="my-auto text-white bg-rp-400 rounded-full border border-rp-400 p-1">
                                {{ sprintf("%02d", $page) }}.
                            </a>
                        @else
                            <a href="{{ $url }}" data-toggle="tooltip" class="bg-white border border-rp-400 text-rp-400 rounded-full my-auto p-1 hover:text-white hover:bg-rp-400 duration-700" title="صفحه {{$page}}">
                                {{ sprintf("%02d", $page) }}.
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="my-auto">
                    <a class="my-auto" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <x-svg.forward class="scale-150"></x-svg.forward>
                    </a>
                </li>
            @else
                <li class="disabled my-auto" aria-disabled="true">
                    <a class="my-auto" aria-hidden="true">
                        <x-svg.forward class="scale-150 fill-slate-300 hover:fill-slate-300"></x-svg.forward>
                    </a>
                </li>
            @endif
        </ul>
    </nav>

@endif
