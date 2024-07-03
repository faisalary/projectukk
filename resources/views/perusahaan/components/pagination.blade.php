@foreach ($pagination['links'] as $key => $item)
@php
    $item['not_number'] = str_contains($item['label'], 'pagination.') ? true : false;
    $item['label'] = str_contains($item['label'], 'pagination.') ? ucfirst(explode('.', $item['label'])[1]) : $item['label'];
@endphp
<li class="page-item {{ $item['active'] ? 'active' : '' }} mx-1" page="prev">
    <a class="page-link {{ $item['url'] == null ? 'disabled' : '' }} {{ $item['not_number'] ? 'px-3' : '' }}" href="javascript:void(0);" onclick="pagination($(this))" data-url="{{ $item['url'] }}">{{ $item['label'] }}</a>
</li>
@endforeach