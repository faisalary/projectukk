@foreach ($logbook_day as $item)
@if (isset($item->id_logbook_day))
<div class="px-4 mb-4" style="border: 1px solid #D3D6DB; border-radius: 6px; background-color:white;">
    <div class="d-flex justify-content-between mt-4">
        <div class="d-flex align-items-center">
            <div class="rounded-pill d-flex flex-column align-items-center justify-content-center" style="background-color: #C4E2D0; width: 70px; height: 70px; ">
                <img src="{{ App\Enums\LogbookDailyEmot::getWithEmot($item->emoticon)['image'] }}" alt="">
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Carbon\Carbon::parse($item->date)->format('l') }}</h6>
                <p class="fw-normal mb-0">{{ Carbon\Carbon::parse($item->date)->format('d F Y') }}</p>
            </div>
        </div>
        <a class='cursor-pointer text-warning' data-id="{{ $item->id_logbook_day }}" onclick="editLogbookDay($(this))"><i class='ti ti-edit ti-md'></i></a>
    </div>
    <p style="color: #B6BAC3; margin-top: 15px;">Kamu melakukan Pekerjaan Apa Hari Ini ?</p>
    <div class="text-block">
        <p class="mb-2">
            @if (Str::wordCount($item->activity) > 25)
            <span class="sibling-fake">{{ Str::words($item->activity, 25, '...') }}</span>
            <span class="sibling-real d-none">{{ $item->activity }}</span>
            <a class="show_hide_new cursor-pointer" data-shortened="true" style="color:#4EA971">Show More</a>
            @else
            <span class="sibling-fake">{{ $item->activity }}</span>
            @endif
        </p>
    </div>
</div>
@else
<div class="ps-4 mb-4 pe-4" style="border: 1px solid #D3D6DB; border-radius: 6px; background-color:white;">
    <div class="d-flex justify-content-between mt-4">
        <div class="d-flex align-items-center">
            <div class="rounded-pill d-flex flex-column align-items-center justify-content-center" style="background-color: #070A0F80; width: 70px; height: 70px;">
                <img src="{{ asset('assets/images/smile.png') }}" alt="" style="filter: grayscale(80%) opacity(50%);">
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Carbon\Carbon::parse($item->date)->format('l') }}</h6>
                <p class="fw-normal mb-0">{{ Carbon\Carbon::parse($item->date)->format('d F Y') }}</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center" style="padding: 20px; margin-bottom: 30px !important;">
        <button type="button" class="btn btn-primary" onclick="createLogbookDay($(this));" data-date="{{ $item->date }}">Buat Laporan Harian</button>
    </div>
</div>
@endif
@endforeach
@if ($can_apply)
<div class="mt-5">
    <button type="button" id="btn-apply" onclick="applyLogbook($(this));" class="btn btn-primary w-100">Ajukan Logbook</button>
</div>
@else
<div class="mt-5">
    <button type="button" id="btn-apply" class="btn btn-primary w-100" disabled>Ajukan Logbook</button>
</div>
@endif