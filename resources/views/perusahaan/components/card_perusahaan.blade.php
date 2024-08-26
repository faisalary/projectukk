@foreach($industries as $key => $i)
    <div class="col-4 mt-4">
        <a href="{{ route('daftar_perusahaan.detail', ['id' => $i['id_industri']]) }}" class="text-decoration-none" style="color: var(--bs-body-color);">
            <div class="card border">
                <div class="card-body">
                    <div class="d-flex justify-content-start">
                        <img class="img-thumbnail" src="{{ url('storage/' . $i['image']) }}" style="max-width: 80px;" alt="admin.upload">
                        <h4 class="mt-3 ms-3">{{$i['namaindustri']}}</h4>
                    </div>
                    <div class="mt-3 mb-2">
                        <i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i>
                        <span>{{$i['alamatindustri']}}</span>
                    </div>
                    <div class="mb-3">
                        <i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;"></i>
                        <span>{{ $i['lowongan_magang_count'] }} lowongan</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach