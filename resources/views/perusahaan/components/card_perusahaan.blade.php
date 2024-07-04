@foreach($industries as $key => $i)
    <div class="col-4 mt-4">
        <a href="{{ route('daftar_perusahaan.detail', ['id' => $i['id_industri']]) }}" style="color: #0C1019;">
            <div class="card border">
                <div class="card-body" style="text-align: left; border-radius: 4px; flex-shrink: 0;">
                    <div>
                        <div class="row">
                            <div class="col-4">
                                <figure class="image" style="border-radius: 0%; margin-left:0px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload"></figure>
                            </div>
                            <div class="col-8">
                                <h4 style="margin-top: 10px;">{{$i['namaindustri']}}</h4>
                            </div>
                        </div>
                        <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i>{{$i['alamatindustri']}}</div>
                        <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach