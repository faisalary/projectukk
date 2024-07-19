<div class="d-flex justify-content-center">
    @foreach ($data as $key => $item)
        <div class="d-flex flex-column justify-content-center align-items-center">
            <span class="badge badge-center rounded-pill {{ $item['active'] ? 'bg-primary' : 'bg-label-primary' }}" style="font-size: 19pt;padding: 1.9rem;">{{ $item['title'] }}</span>
        </div>
        @if (($key+1) != count($data))
        <div style="width: 10%;" class="position-relative mx-4">
            <span class="w-100 position-absolute start-50 translate-middle" style="top:35px;border: 1px solid #4EA971"></span>
        </div>
        @endif
    @endforeach
</div>
<div class="d-flex justify-content-center">
    <span class="fw-semibold mt-4 text-center" style="width: 245px;">Belum diproses</span>
    <span class="fw-semibold mt-4 text-center" style="width: 245px;">Screening</span>
    <span class="fw-semibold mt-4 text-center" style="width: 245px;">Seleksi</span>
    <span class="fw-semibold mt-4 text-center" style="width: 245px;">Penawaran</span>
    <span class="fw-semibold mt-4 text-center" style="width: 245px;">Diterima/Ditolak</span>
</div>