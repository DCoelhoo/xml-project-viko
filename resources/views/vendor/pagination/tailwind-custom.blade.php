@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4">
        <ul class="inline-flex items-center space-x-1">

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded cursor-not-allowed">
                        ‹
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-1 bg-white border rounded hover:bg-gray-100 text-gray-700 transition">
                        ‹
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="px-3 py-1 text-gray-400">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-3 py-1 bg-blue-600 text-white rounded">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-3 py-1 bg-white border rounded hover:bg-gray-100 text-gray-700 transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-1 bg-white border rounded hover:bg-gray-100 text-gray-700 transition">
                        ›
                    </a>
                </li>
            @else
                <li>
                    <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded cursor-not-allowed">
                        ›
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif