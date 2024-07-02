@if($industries->count() != 0)
    <h4 class="ms-2 mt-2 mb-0">Daftar Mitra</h4>
    <div class="row">
        @foreach($industries as $i)
        <div class="col-4 mt-5 page-content page-{{$page = ceil($loop->iteration/$page_per)}}" @if($page != 1) style="display: none" @endif>
            <a href="/daftar_perusahaan/detail/{{$i->id_industri}}" style="color: #0C1019;">
                <div class="card border">
                    <div class="card-body" style="text-align: left; border-radius: 4px; flex-shrink: 0;">
                        <div>
                            <div class="row">
                                <div class="col-4">
                                    <figure class="image" style="border-radius: 0%; margin-left:0px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload"></figure>
                                </div>
                                <div class="col-8">
                                    <h4 style="margin-top: 10px;">{{$i->namaindustri}}</h4>
                                </div>
                            </div>
                            <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i>{{$i->alamatindustri}}</div>
                            <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>{{$i->kategori_industri}} </div>
                            <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end mb-5 mt-4">
            <li class="page-item" page="prev">
                <a class="page-link waves-effect" href="javascript:void(0);">Previous</a>
            </li>
            @for($i = 1; $i <= ceil($industries->count()/$page_per); $i++)
                <li class="page-item {{$i == 1 ? 'active' : ''}}" page="{{$i}}">
                    <a class="page-link waves-effect" href="javascript:void(0);">{{$i}}</a>
                </li>
            @endfor
            <li class="page-item " page="next">
                <a class="page-link waves-effect" href="javascript:void(0);">Next</a>
            </li>
        </ul>
    </nav>
@else
    <img src="\assets\images\nothing.svg" alt="no-data" style="display: flex; margin-left: 
    auto; margin-right: auto; margin-top: 5%; margin-bottom: 5%;  width: 25%;">
    <div class="sec-title mt-5 mb-4 text-center">
        <h4>Belum ada mitra yang terdaftar</h4>
    </div>
@endif