@if (count($dokumenPendukung) > 0)
@foreach ($dokumenPendukung as $key => $item)
<div class="mb-3 pb-3 {{ count($dokumenPendukung) != ($key+1) ? 'border-bottom' : '' }}">
    <div class="d-flex justify-content-between mb-1">
        <h5 class="fw-bolder mb-0">{{ $item->nama_sertif }}</h5>
        <div class="d-flex justify-content-end">
            <a class="cursor-pointer mx-1 text-warning" onclick="editData($(this))" data-target-modal="modalTambahDokumen" data-id="{{ $item->id_sertif }}">
                <i class="ti ti-edit"></i>
            </a>
            <a class="cursor-pointer mx-1 text-danger" onclick="deleteData($(this))" data-function="afterDeleteDokumen" data-url="{{ route('profile.delete_dokumen', ['id' => $item->id_sertif]) }}">
                <i class="ti ti-trash"></i>
            </a>
        </div>
    </div>
    <p class="mb-1" style="font-size: small">{{ $item->penerbit }}</p>
    <p class="mb-1">{{ Carbon\Carbon::parse($item->startdate)->format('F Y') }}&ensp;-&ensp;{{ Carbon\Carbon::parse($item->enddate)->format('F Y') }}</p>
    <p class="mb-1">{{ $item->deskripsi }}</p>
    <div class="d-flex justfiy-content-start align-items-center">
        <a href="{{ url('storage/'.$item->file_sertif) }}" target="_blank">
            @php
                $image = url('storage/'.$item->file_sertif);
                $fileInfo = pathinfo($image);
                if (isset($fileInfo['extension']) && strtolower($fileInfo['extension']) === 'pdf') {
                    $image = asset('app-assets/img/icons/misc/pdf2.png');
                }
            @endphp
            <img class="me-2" src="{{ $image }}" width="150" height="auto" alt="img">                
        </a>
    </div>
</div>
@endforeach
@else
<h2>Kosong, seperti otakmu.</h2>
@endif