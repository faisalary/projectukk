@if (count($pendidikan) > 0)
<ul class="timeline mb-0">
    @foreach ($pendidikan as $key => $item)
    <li class="timeline-item timeline-item-transparent {{ count($pendidikan) == ($key + 1) ? 'border-0' : '' }}">
        <span class="timeline-point timeline-point-primary"></span>
        <div class="timeline-event pe-0">
            <div class="timeline-header mb-2">
                <h5 class="fw-bolder mb-0">{{ $item->name_intitutions }}</h5>
                <div class="d-flex justify-content-end">
                    <a class="cursor-pointer mx-1 text-warning" onclick="editData($(this))" data-target-modal="modalTambahPendidikan" data-id="{{ $item->id_education }}">
                        <i class="ti ti-edit"></i>
                    </a>
                    <a class="cursor-pointer mx-1 text-danger" onclick="deleteData($(this))" data-function="afterDeletePendidikan" data-url="{{ route('profile.delete_pendidikan', ['id' => $item->id_education]) }}">
                        <i class="ti ti-trash"></i>
                    </a>
                </div>
            </div>
            <p class="mb-1">{{ $item->tingkat }}</p>
            <p class="mb-1">Nilai: {{ $item->nilai }}</p>
            <small>{{ Carbon\Carbon::parse($item->startdate)->format('F Y') }}&ensp;-&ensp;{{ Carbon\Carbon::parse($item->enddate)->format('F Y') }}</small>
        </div>
    </li>
    @endforeach
</ul>
@else
    <h2>Kosong</h2>
@endif