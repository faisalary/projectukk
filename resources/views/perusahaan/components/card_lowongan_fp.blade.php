@foreach($lowongan as $l)
    <div class="col-12 mt-3 mb-2">
        <div class="card border cursor-pointer" data-id="{{$l['id_lowongan']}}" onclick="detail($(this))">
            <div class="card-body">
                <div class="d-flex justify-content-between card-header mb-3" style="background-color: #FFFFFF; padding:0px;">
                    <div class="d-flex justify-content-start">
                        @if ($l['image'])
                            <img src="{{ asset('storage/' . $l['image']) }}" alt="user-avatar" id="imgPreview">
                        @else
                            <img src="../../app-assets/img/avatars/14.png" alt="user-avatar" class="" height="65" width="65" id="imgPreview" data-default-src="../../app-assets/img/avatars/14.png">
                        @endif
                        <div class="ms-2 my-auto">
                            <h5 class="mb-1 text-truncate">{{$l['intern_position'] ?? ''}}</h5>
                            <p class="mb-0">{{$l['namaindustri'] ?? ''}}</p>
                        </div>
                    </div>
                    <div class="ms-2">
                        <a href="javascript:void(0)" onclick="myFunction(this)" class="text-primary">
                            <i class="fa fa-bookmark-o" style="font-size: 25px;"></i>
                        </a>
                    </div>
                </div>
                <div class="border"></div>
                <div class="map-pin mt-3 mb-3">
                    <i class="ti ti-map-pin" style="margin-right: 10px;margin-bottom:5px;"></i>
                    {{ implode(', ', json_decode($l['lokasi'])) }}
                </div>
                <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px">
                    <i class="ti ti-currency-dollar" style="margin-right: 10px;margin-bottom:5px;"></i>
                    {{ $l['nominal_salary'] ?? 'Tidak Berbayar' }}
                </div>
                <div class="briefcase mb-3" style="margin-left: 1px;">
                    <i class="ti ti-calendar-time" style="margin-right: 10px;margin-bottom:5px;"></i>
                    {{ implode(' dan ', json_decode($l['durasimagang'])) }}
                </div>
                <div class="briefcase mb-3" style="margin-left: 1px;">
                    <i class="ti ti-users" style="margin-right: 10px;margin-bottom:5px;"></i>
                    {{$l['kuota'] ?? ''}} Kuota Penerimaan
                </div>
            </div>
        </div>
    </div>
@endforeach