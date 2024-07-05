@foreach ($lowongan as $key => $item)
<div class="py-4 d-flex justify-content-between {{ ($key+1) != count($lowongan) ? 'border-bottom' : '' }}">
    <div class="d-flex justify-content-start align-items-center">
        <img style="border-radius: 0%; width:150px;" src="{{ url('storage/' . $detail->image ) }}" alt="admin.upload">
        <div class="ms-3">
            <h2 class="mb-1">{{ $item['intern_position'] }}</h2>
            <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">{{ $detail->namaindustri }}</p>
            <p>{{ $detail->alamatindustri }}</p>
        </div>
    </div>
    <div class="mt-2">
        <i class="ti ti-clock mb-1"> </i> 
        {{ Carbon\Carbon::parse($item['created_at'])->diffForHumans(Carbon\Carbon::now()) }}
    </div>
</div>
@endforeach