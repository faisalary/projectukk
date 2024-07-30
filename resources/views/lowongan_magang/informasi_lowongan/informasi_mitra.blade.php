@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="d-flex justify-content-start">
    <a href="{{ route('lowongan.informasi') }}" class="btn btn-outline-primary">
        <i class="ti ti-arrow-left"></i>
        Kembali
    </a>
</div>
<div class="row mt-3">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Lowongan Magang / </span>Informasi Lowongan - Tahun Ajaran 2324</h4>
    </div>
    <div class="col-md-3 col-12 mb-3 float-end d-flex justify-content-end">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="card shadow-none border border-secondary">
                            <div class="card-body py-2 px-2">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="badge bg-label-primary p-2 me-2">
                                        <i class="ti ti-users" style="font-size: 12pt;"></i>
                                    </span>
                                    <span class="mb-0 me-2">Total Pelamar :</span>
                                    <h5 class="mb-0 me-2 text-primary" id="set_total_pelamar">0</h5>
                                    <span class="mb-0 me-2">Kandidat Melamar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="card shadow-none border border-secondary">
                            <div class="card-body py-2 px-2">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="badge bg-label-primary p-2 me-2">
                                        <i class="ti ti-briefcase" style="font-size: 12pt;"></i>
                                    </span>
                                    <span class="mb-0 me-2">Total Lowongan :</span>
                                    <h5 class="mb-0 me-2 text-primary" id="set_total_lowongan">0</h5>
                                    <span class="mb-0 me-2">Lowongan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="table-responsive">
                        <table class="" id="table">
                            <thead><td></td></thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        loadData();
    });

    function loadData(){
        $('#table').DataTable({
            ajax: "{{ $urlGetData }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            destroy: true,
            drawCallback: function ( settings, json ) {
                let total = this.api().data().count();
                let totalPelamar = 0;

                $('.total_pelamar').each(function () {
                    totalPelamar += parseInt($(this).text());
                });

                $('#set_total_lowongan').text(total);
                $('#set_total_pelamar').text(totalPelamar);
            },
            columns: [{data: "data"}],
            language: {
                emptyTable: `<img src="{{ asset('assets/images/lowongan-empty.svg') }}" alt="no-data" style="display: flex; margin-left: auto; margin-right: auto; margin-top: 5%; margin-bottom: 5%;  max-width: 80%;">`,
            },
            ordering: false
        });
    }
</script>
@endsection