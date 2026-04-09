@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        {{-- Mobile (simple buttons) --}}
        <div class="flex gap-2 items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm rounded bg-gray-200 text-gray-400 cursor-not-allowed">
                    ← Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-4 py-2 text-sm rounded bg-gray-200 hover:bg-[#9773B3] hover:text-white transition">
                    ← Previous
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-4 py-2 text-sm rounded bg-gray-200 hover:bg-[#9773B3] hover:text-white transition">
                    Next →
                </a>
            @else
                <span class="px-4 py-2 text-sm rounded bg-gray-200 text-gray-400 cursor-not-allowed">
                    Next →
                </span>
            @endif

        </div>

        {{-- Desktop (your styled version) --}}
        <div class="hidden sm:flex justify-center mt-6">
            <nav class="flex items-center gap-2">

                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-2 rounded-full bg-gray-200 text-gray-400 cursor-not-allowed">←</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-2 rounded-full bg-gray-200 shadow-sm hover:bg-[#9773B3] hover:text-white transition">
                        ←
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($elements as $element)

                    {{-- Dots --}}
                    @if (is_string($element))
                        <span class="px-2 text-gray-500">{{ $element }}</span>
                    @endif

                    {{-- Pages --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-4 py-2 rounded-full bg-[#9773B3] text-white font-bold shadow">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   class="px-4 py-2 rounded-full bg-gray-200 shadow-sm hover:bg-[#9773B3] hover:text-white transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif

                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-2 rounded-full bg-gray-200 shadow-sm hover:bg-[#9773B3] hover:text-white transition">
                        →
                    </a>
                @else
                    <span class="px-3 py-2 rounded-full bg-gray-200 text-gray-400 cursor-not-allowed">→</span>
                @endif

            </nav>
        </div>

    </nav>
@endif