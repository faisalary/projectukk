@extends('partials.vertical_menu')

@section('page_style')
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Kelola Mahasiswa</h4>
    </div>
    <div class="col-md-3 col-12 mb-3  d-flex align-items-center justify-content-between">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">21/10/2023-10/11/2023</option>
        </select>
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
        </button>
    </div>
</div>

<div class="row ps-2 pe-3">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="table" id="table-lapangan">
                <thead>
                    <tr>
                        <th style="min-width: 50px;">NOMOR</th>
                        <th style="min-width:150px;">NAMA</th>
                        <th style="min-width:150px;">PROGRAM STUDI</th>
                        <th style="min-width:150px;">POSISI MAGANG</th>
                        <th style="min-width:150px;">DURASI MAGANG</th>
                        <th style="min-width:150px;">JENIS MAGANG</th>
                        <th style="min-width:100px;text-align:center;">NILAI AKHIR</th>
                        <th style="min-width:100px;text-align:center;">INDEKS</th>
                        <th style="min-width:150px;text-align:center;">STATUS MAGANG</th>
                        <th style="min-width:130px;text-align:center;">AKSI</th>
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
                        <label for="nama/nim" class="form-label">Posisi Magang</label>
                        <select class="form-select select2" id="posisi" name="posisi" data-placeholder="Pilih Posisi Magang">
                            <option value="">Pilih Posisi Magang</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="nama/nim" class="form-label">Status</label>
                        <select class="form-select select2" id="status" name="status" data-placeholder="Pilih Status">
                            <option value="">Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="2">Non-Aktif</option>
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

<!-- Modal Dipulangkan-->
<div class="modal fade" id="modalDipulangkan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="modalDipulangkan">Anda memulangkan arvin bagaskara, Silahkan Memberikan alasan dan bukti !!!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <div class="row mb-3">
                    <div class="col mb-0">
                        <label for="defaultFormControlInput" class="form-label pb-1">Alasan pemulangan mahasiswa<span class="text-danger">*</span> </label>
                        <textarea class="form-control" id="defaultFormControlInput" placeholder="Tulis komentar disini" aria-describedby="defaultFormControlHelp"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-0">
                        <label for="formFile" class="form-label">Bukti Memulangkan Mahasiswa<span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="formFile">
                        <p style="font-size: 10px;">Allowed PDF, PNG, JPG, JPEG. Max size 1 GB</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalalert">Kirim Komentar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alert-->
<div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-0">
                <img src="../../app-assets/img/alert.png" alt="">
                <h5 class="modal-title" id="modal-title">Apakah anda yakin ingin memulangkan mahasiswa?</h5>
                <p>Pilihan Anda akan secara otomatis memperbarui data dan membatasi akses yang tersedia bagi mahasiswa.</p>
                <div class="swal2-html-container" id="swal2-html-container" style="display: block;"></div>
            </div>
            <div class="modal-footer" style="display: flex; justify-content:center;">
                <button type="submit" id="modal-button" class="btn btn-success">Ya, Sudah</button>
                <button type="submit" id="modal-button" class="btn btn-danger">Batal</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page_script')
<script>
    var table = $('#table-lapangan').DataTable({
        ajax: `{{ route('kelola_magang_pemb_lapangan.get_data') }}`,
        scrollX: true,
        columns: [
            { data: "DT_RowIndex" },
            { data: "namamhs" },
            { data: "namaprodi" },
            { data: "intern_position" },
            { data: "durasimagang" },
            { data: "namajenis" },
            { data: "nilai_akhir" },
            { data: "indeks" },
            { data: "status" },
            { data: "aksi" }
        ],
        columnDefs: [
            { "width": "50px", "targets": 0 },
            { "width": "150px", "targets": 1 },
            { "width": "150px", "targets": 2 },
            { "width": "150px", "targets": 3 },
            { "width": "150px", "targets": 4 },
            { "width": "150px", "targets": 5 },
            { "width": "100px", "targets": 6 },
            { "width": "100px", "targets": 7 },
            { "width": "150px", "targets": 8 },
            { "width": "130px", "targets": 9 }
        ],
        fixedColumns: { left: 2, right: 1 },
    });
</script>
<script src="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection