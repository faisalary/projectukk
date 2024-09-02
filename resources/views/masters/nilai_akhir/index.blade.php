@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Nilai Akhir</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-nilai-akhir">Tambah Presentase Nilai</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table table-striped" id="table-master-nilai-akhir">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>Program Studi</th>
                            <th>Presentase Nilai Pembimbing Lapangan(%)</th>
                            <th>Presentase Nilai Pembimbing Akademik (%)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                D3 Sistem Informasi
                            </td>
                            <td>
                                40
                            </td>
                            <td>
                                60
                            </td>
                            <td class="d-flex">
                                <button class="btn">
                                    <i class="tf-icons ti ti-edit"></i>
                                </button>
                                <button class="btn">
                                    <i class="tf-icons ti ti-trash"></i>
                                </button>
                                <button class="btn">
                                    <i class="tf-icons ti ti-circle-check"></i>
                                </button>
                                {{-- <i data-feather='edit'></i> --}}
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                D3 Rekayasa Perangkat Lunak Aplikasi
                            </td>
                            <td>
                                45
                            </td>
                            <td>
                                55
                            </td>
                            <td class="d-flex">
                                <button class="btn">
                                    <i class="tf-icons ti ti-edit"></i>
                                </button>
                                <button class="btn">
                                    <i class="tf-icons ti ti-trash"></i>
                                </button>
                                <button class="btn">
                                    <i class="tf-icons ti ti-circle-x"></i>
                                </button>
                                {{-- <i data-feather='edit'></i> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('masters.nilai_akhir.modal')

@endsection

@section('page_script')
<script>
      $('#table-master-nilai-akhir').DataTable({})
</script>
@endsection