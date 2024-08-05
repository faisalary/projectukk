@extends('partials.vertical_menu')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Mitra /</span> Kelola Mitra</h4>
        </div>
        <div class="col-md-6 col-12 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMitra">Tambah Mitra</button>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-3 " role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-pending" aria-controls="navs-pills-justified-pending"
                        aria-selected="true">
                        <i class="tf-icons ti ti-clock ti-xs me-1"></i> Pending
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-verified" aria-controls="navs-pills-justified-verified"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Verified
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-rejected" aria-controls="navs-pills-justified-rejected"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Rejected
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                @foreach (['pending', 'verified', 'rejected'] as $key => $item)
                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="navs-pills-justified-{{ $item }}" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="{{ $item }}">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th style="min-width: 120px;">NOMOR TELEPON</th>
                                    <th>PENANGGUNG JAWAB</th>
                                    <th>KATEGORI MITRA</th>
                                    <th>STATUS KERJASAMA</th>
                                    <th style="text-align:center;">AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @include('company.kelola_mitra.modal')
    </div>
@endsection

@section('page_script')
    <script>
        $(document).ready(function () {
            loadData();
        });

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
        });


        function afterAction(response) {
            $('#modalTambahMitra').modal('hide');
            $('.table').each(function () {
                $(this).DataTable().ajax.reload();
            });
        }

        function loadData() {
            $('.table').each(function () {
                $(this).DataTable({
                    ajax: "{{ route('kelola_mitra.show') }}?status=" + $(this).attr('id'),
                    scrollX: true,
                    autoWidth: false,
                    scrollCollapse: true,
                    destroy: true,
                    columns: [{
                            data: 'DT_RowIndex'
                        },

                        {
                            data: 'namaindustri',
                            name: 'namaindustri'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'notelpon',
                            name: 'notelpon'
                        },
                        {
                            data: 'penanggung_jawab',
                            name: 'penanggung_jawab'
                        },
                        {
                            data: 'kategori_industri',
                            name: 'kategori_industri'
                        },
                        {
                            data: 'statuskerjasama',
                            name: 'statuskerjasama'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi'
                        }
                    ]
                });
            });
        }

        function edit(e) {
            let id = e.attr('data-id');
            let action = `{{ route('kelola_mitra.update', ['id' => ':id']) }}`.replace(':id', id);
            let url = `{{ route('kelola_mitra.edit', ['id' => ':id']) }}`.replace(':id', id);
            let modal = $('#modalTambahMitra');

            modal.find('.modal-title').html("Edit Mitra");
            modal.find('form').attr('action', action);
            modal.modal('show');

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#nama').val(response.namaindustri);
                    $('#email').val(response.email);
                    $('#contact_person').val(response.contact_person);
                    $('#penanggung_jawab').val(response.penanggung_jawab);
                    $('#alamat').val(response.alamatindustri);
                    $('#deskripsi').val(response.description);
                    $('#kategori').val(response.kategori_industri).trigger('change');
                    $('#statuskerjasama').val(response.statuskerjasama).trigger('change');
                }
            });
        }

        $(".modal").on("hide.bs.modal", function() {
            let dataLabel = $(this).find('.modal-title').attr('data-label');
            $(this).find('.modal-title').html(dataLabel);
        });

        function approved(e) {
            $('#modalapprove').modal('show');

            sweetAlertConfirm({
                title: 'Konfirmasi Persetujuan Data Mitra',
                text: 'Apakah anda yakin untuk menyetujui data mitra?',
                icon: 'warning',
                confirmButtonText: 'Ya, Yakin',
                cancelButtonText: 'Batal',
            }, function () {
                $.ajax({
                    url: `{{ route('kelola_mitra.approved', ['id' => ':id']) }}`.replace(':id', e.attr('data-id')),
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (!response.error) {
                            loadData();
                            showSweetAlert({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success'
                            });
                        } else {
                            showSweetAlert({
                                title: 'Gagal!',
                                text: response.message,
                                icon: 'error'
                            });
                        }
                    }
                });

                $('#modalapprove').modal('hide'); 
            });
        }

        function rejected(e) {
            $('#modalreject').modal('show');
            $('#rejected-confirm-button').on('click', function() {
                btnBlock($(this));

                var alasan = $('#alasan').val();

                $.ajax({
                    url: `{{ route('kelola_mitra.rejected', ['id' => ':id']) }}`.replace(':id', e.attr('data-id')),
                    type: "POST",
                    data: {
                        alasan: alasan,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        btnBlock($(this), false);
                        if (!response.error) {
                            showSweetAlert({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success'
                            });
                        } else {
                            showSweetAlert({
                                title: 'Gagal!',
                                text: response.message,
                                icon: 'error'
                            });
                        }
                        $('#modalreject').modal('hide');
                    }
                });
            });
        }
    </script>
@endsection
