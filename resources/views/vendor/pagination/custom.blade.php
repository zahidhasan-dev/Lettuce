@if ($paginator->hasPages())
    <div class="ltn__pagination-area text-center">
        <div class="ltn__pagination">
            <ul>
                @if($paginator->onFirstPage())
                    <li><a style="cursor:not-allowed;background:#fff;border:2px solid #ededed;color:#000;" href="javascript:void(0);"><i class="fas fa-angle-double-left"></i></a></li>
                @else
                    <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-angle-double-left"></i></a></li>
                @endif

                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($paginator->currentPage() > 4 && $page === 2)
                                <li><a  style="cursor:default;background:#fff;border:2px solid #ededed;color:#000;" href="javascript:void(0);">...</a></li>
                            @endif

                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href="javascript:void(0);">{{ $page }}</a></li>
                            @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif

                            @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                                <li><a  style="cursor:default;background:#fff;border:2px solid #ededed;color:#000;" href="javascript:void(0);">...</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach 

                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-angle-double-right"></i></a></li>
                @else
                    <li><a style="cursor:not-allowed;background:#fff;border:2px solid #ededed;color:#000;" href="javascript:void(0);"><i class="fas fa-angle-double-right"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
@endif