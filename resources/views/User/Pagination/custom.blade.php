@if ($paginator->hasPages())
    <div class="col-12 wow fadeInUp my-5" data-wow-delay="0.1s">
        <div class="pagination d-flex justify-content-center mt-5">

            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <a class="rounded disabled">&laquo;</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="rounded">&laquo;</a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                {{-- Array Of Pages --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="rounded">&raquo;</a>
            @else
                <a class="rounded disabled">&raquo;</a>
            @endif

        </div>
    </div>
@endif
