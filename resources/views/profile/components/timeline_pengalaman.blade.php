@if (count($experience) > 0)
<ul class="timeline ms-2 mb-0">
    @foreach ($experience as $key => $item)
    <li class="timeline-item timeline-item-transparent ps-4 {{ count($experience) == ($key + 1) ? 'border-0' : '' }}">
        <span class="timeline-point timeline-point-primary"></span>
        <div class="timeline-event pe-4">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bolder mb-2">{{ $item->posisi }}</h5>
                <div class="d-flex justify-content-end">
                    <a class="cursor-pointer mx-1 text-warning" onclick="editData($(this))" data-target-modal="modalTambahPengalaman" data-id="{{ $item->id_experience }}">
                        <i class="ti ti-edit"></i>
                    </a>
                    <a class="cursor-pointer mx-1 text-danger" onclick="deleteData($(this))" data-function="afterDeleteExperience" data-url="{{ route('profile.delete_experience', ['id' => $item->id_experience]) }}">
                        <i class="ti ti-trash"></i>
                    </a>
                </div>
            </div>
            <p class="mb-1">{{ $item->name_intitutions }}&ensp;-&ensp;{{ $item->jenis }}</p>
            <small>{{ $item->startdate }}&ensp;-&ensp;{{ $item->enddate }}</small>
            <p class="mt-1 mb-0">{{ $item->deskripsi }}</p>
        </div>
    </li>
    @endforeach
</ul>
@else
<h2>Kosong</h2>
@endif