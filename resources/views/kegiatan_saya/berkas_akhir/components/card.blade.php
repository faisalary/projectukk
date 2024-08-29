@foreach ($berkas_akhir as $item)
@if (isset($item->berkas_file))
<div class="border text-center py-4 mt-4" style="border-radius: 8px; background-color:#fff">
    <h4 class="mt-1">Terkirim! {{ $item->nama_berkas }} Anda telah berhasil diserahkan</h4>
    <p>Silahkan lakukan pengecekan detail dokumen dibawah ini.</p>
    <a href="{{ url('storage/' . $item->berkas_file) }}" class="text-primary mb-1" download>{{ $item->nama_berkas }}.{{ explode('.', $item->berkas_file)[1] }}</a>
</div>
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