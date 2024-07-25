@if (count($skills) > 0)
@foreach ($skills as $item)
<span class="badge rounded-pill mx-1 bg-primary">{{ $item }}</span>
@endforeach
@else
<h2>Kosong, seperti otakmu.</h2>
@endif