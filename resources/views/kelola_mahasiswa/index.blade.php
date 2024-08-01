@extends('partials.vertical_menu')

@section('page_style')
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Kelola Mahasiswa</span></h4>
    </div>
    <div class="col-md-3 col-12 mb-3 d-flex align-items-center justify-content-between">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">21/10/2023-10/11/2023</option>
        </select>
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i></button>
    </div>
</div>

<div class="row ps-2 pe-3">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="table" id="table-akademik">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>PROGRAM STUDI</th>
                        <th>POSISI MAGANG</th>
                        <th>PERUSAHAAN</th>
                        <th>DURASI MAGANG</th>
                        <th>JENIS MAGANG</th>
                        <th>BERKAS AKHIR MAGANG</th>
                        <th>NILAI AKHIR</th>
                        <th>INDEKS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Filter Berdasarkan</h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="mb-2">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Program Studi">
                            <option value="">Pilih Program Studi</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="magang" class="form-label">Jenis Magang</label>
                        <select class="form-select select2" id="magang" name="magang" data-placeholder="Pilih Jenis Magang">
                            <option value="">Pilih Jenis Magang</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="reset" class="btn btn-label-danger data-reset">Reset</button>
                <button type="submit" class="btn btn-success">Terapkan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('page_script')
<script src="{{ asset('app-assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="{{ asset('app-assets/js/forms-extras.js') }}"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.0/js/dataTables.fixedColumns.js"></script>
<script>
    $(document).ready(function() {
        $('#table-akademik').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('kelola_mhs_pemb_akademik.get_data') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    defaultContent: ''
                },
                {
                    data: 'namamhs',
                    name: 'mahasiswa.namamhs',
                    defaultContent: '-'
                },
                {
                    data: 'namaprodi',
                    name: 'program_studi.namaprodi',
                    defaultContent: '-'
                },
                {
                    data: 'intern_position',
                    name: 'lowongan_magang.intern_position',
                    defaultContent: '-'
                },
                {
                    data: 'namaindustri',
                    name: 'industri.namaindustri',
                    defaultContent: '-'
                },
                {
                    data: 'durasimagang',
                    name: 'lowongan_magang.durasimagang',
                    defaultContent: '-'
                },
                {
                    data: 'jenis_magang',
                    name: 'mhs_magang.jenis_magang',
                    defaultContent: '-'
                },
                {
                    data: 'berkas_akhir',
                    name: 'berkas_akhir',
                    defaultContent: '-'
                },
                {
                    data: 'nilai_akhir_magang',
                    name: 'mhs_magang.nilai_akhir_magang',
                    defaultContent: '0'
                },
                {
                    data: 'indeks_nilai_akhir',
                    name: 'mhs_magang.indeks_nilai_akhir',
                    defaultContent: '-'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false,
                    defaultContent: ''
                },
            ],
            fixedColumns: true,
        });
    });
</script>
@endsection