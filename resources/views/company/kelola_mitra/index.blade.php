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
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">2</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-verified" aria-controls="navs-pills-justified-verified"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Verified
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">4</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-rejected" aria-controls="navs-pills-justified-rejected"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Rejected
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">1</span> --}}
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

        function afterAction(response) {
            $('#modalTambahMitra').modal('hide');
            $('#datatables-kelas').DataTable().ajax.reload();
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
            var url = `{{ route('kelola_mitra.edit', ['id' => ':id']) }}`.replace(':id', id);
            let modal = $('#modalTambahMitra');

            modal.find('.modal-title').html("Edit Mitra");
            modal.find('#simpanButton').html("Update Data");
            simpanButton.find('form').attr('action', action);

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#nama').val(response.namaindustri);
                    $('#email').val(response.email);
                    $('#notelpon').val(response.notelpon);
                    $('#alamatindustri').val(response.alamatindustri);
                    $('#kategori').val(response.kategori_industri).trigger('change');
                    $('#statuskerjasama').val(response.statuskerjasama).trigger('change');
                    $('#modalTambahMitra').modal('show');
                }
            });
        }

        $(".modal").on("hide.bs.modal", function() {
            let dataLabel = $(this).find('.modal-title').attr('data-label');
            $(this).find('.modal-title').html(dataLabel);
        });

        function approved(e) {

            $('#modalapprove').modal('show');
            var approveUrl = `{{ route('kelola_mitra.approved', ['id' => ':id']) }}`.replace(':id', e.attr('data-id'));

            $('#approve-confirm-button').on('click', function() {

                $.ajax({
                    url: approveUrl,
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (!response.error) {
                            alert('berhasil');
                        } else {
                            alert('tidak berhasil');
                        }
                    }
                });

                $('#modalapprove').modal('hide');
            });
        }

        function rejected(e) {
            $('#modalreject').modal('show');
            var rejectedUrl = `{{ route('kelola_mitra.rejected', ['id' => ':id']) }}`.replace(':id', e.attr('data-id'));

            $('#rejected-confirm-button').on('click', function() {
                var alasan = $('#alasan').val();

                $.ajax({
                    url: rejectedUrl,
                    type: "POST",
                    data: {
                        alasan: alasan,
                        _token: '{{ csrf_token() }}'
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (!response.error) {
                            alert('berhasil');
                        } else {
                            alert('tidak berhasil');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                $('#modalreject').modal('hide');
            });
        }
    </script>
@endsection
