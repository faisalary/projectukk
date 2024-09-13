@foreach ($berkas_akhir as $item)
@if (isset($item->berkas_file))
    @if ($item->status_berkas == App\Enums\BerkasAkhirMagangStatus::REJECTED)
    <div class="border text-center pt-4 pb-5 mt-4" style="border-radius: 8px; background-color:#fff">
        <div class="d-flex justify-content-end mx-4">
            @php
                $status = App\Enums\BerkasAkhirMagangStatus::getWithLabel($item->status_berkas);
                $item->status_berkas = '<span class="badge bg-label-'.$status['color'].'">'.$status['title'].'</span>';
            @endphp
            {!! $item->status_berkas !!}
        </div>
        <h4>Upss! {{ $item->nama_berkas }} membutuhkan perbaikan</h4>
        <p>Silahkan lakukan pengecekan detail dokumen dibawah ini.</p>
        <button type="button" class="btn btn-outline-danger btn-upload-berkas mb-1" data-id="{{ $item->id_berkas_magang }}" data-berkas="{{ $item->nama_berkas }}"><i class="ti ti-edit"></i>&ensp;Perbaiki Laporan Harian Magang</button>
        <hr class="mx-5">
        <div class="text-start mx-5">
            <p class="text-danger fw-bolder mb-1">Komentar Perbaikan:</p>
            <p>{{ $item->rejected_reason }}</p>
        </div>
    </div>
    @else
    <div class="border text-center pt-4 pb-5 mt-4" style="border-radius: 8px; background-color:#fff">
        <div class="d-flex justify-content-end mx-4">
            @php
                $status = App\Enums\BerkasAkhirMagangStatus::getWithLabel($item->status_berkas);
                $item->status_berkas = '<span class="badge bg-label-'.$status['color'].'">'.$status['title'].'</span>';
            @endphp
            {!! $item->status_berkas !!}
        </div>
        <h4>Terkirim! {{ $item->nama_berkas }} Anda telah berhasil diserahkan</h4>
        <p>Silahkan lakukan pengecekan detail dokumen dibawah ini.</p>
        <a href="{{ url('storage/' . $item->berkas_file) }}" class="text-primary mb-1" download>{{ $item->nama_berkas }}.{{ explode('.', $item->berkas_file)[1] }}</a>
    </div>
    @endif
@else
<div class="border text-center py-4 mt-4" style="border-radius: 8px; background-color:#fff">
    <h4 class="mt-1">{{ $item->nama_berkas }}</h4>
    <p>Harap pastikan bahwa laporan akhir magang Anda telah lengkap dan selesai sepenuhnya. Anda hanya memiliki satu kesempatan untuk mengunggahnya.</p>
    <div class="d-flex flex-column align-items-center">
        <a href="{{ url('storage/' . $item->template) }}" class="text-primary mb-3" download>Template File.{{ explode('.', $item->template)[1] }}</a>
        <button type="button" class="btn btn-primary btn-upload-berkas mb-1" data-id="{{ $item->id_berkas_magang }}" data-berkas="{{ $item->nama_berkas }}">Upload</button>
    </div>
</div>
@endif
@endforeach