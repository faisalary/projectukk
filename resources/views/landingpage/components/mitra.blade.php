<div class="row mx-5">
    @foreach ($mitra as $item)
        <div class="col-4 mt-5">
            <div class="card">
                <div class="card-body text-start">
                    <div>
                        <img class="img-thumbnail" src="{{ $item->image }}" style="max-height: 80px;" alt="admin.upload">
                        <h4 style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                            {{ $item->namaindustri }}
                        </h4>
                        <div class="location" style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                            {{ $item->alamatindustri }}
                        </div>
                        <div class="button-container">
                            <a href="{{ route('daftar_perusahaan.detail', ['id' => $item->id_industri]) }}?url_back={{ $urlBack }}" class="btn btn-outline-primary mt-3">Lihat Perusahaan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>