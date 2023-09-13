@if ($paginator->hasPages())
    <nav class="ls-pagination">
        <ul>
        @if ($paginator->onFirstPage())
            <li class="prev disabled" ><i class="fa fa-arrow-left"></i></li>
        @else
            <li class="prev relative"><a href="{{ $paginator->previousPageUrl() }}" rel="prev" wire:loading.attr="disabled"><i class="fa fa-arrow-left"></i></a></li>
        @endif


    
        @foreach ($elements as $element)
        
            {{-- @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif --}}


        
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a class="active"><span>{{ $page }}</span></a></li>
                    @else
                        <li class="current-page"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next" wire:loading.attr="disabled"><i class="fa fa-arrow-right"></i></a></li>
        @else
            <li class="next disabled" ><i class="fa fa-arrow-right"></i></li>
        @endif
    </ul>
@endif 


<script>
$('.pagination a').on('click', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.get(url, function (data) {
        $('html').html(data.replace("$1"));
    });
});
</script>