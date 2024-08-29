@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="row mb-2">
    <div class="">
        <a href="{{ route('kelola_magang_pemb_lapangan') }}" type="button" class="btn btn-outline-primary mb-3 waves-effect">
            <span class="ti ti-arrow-left me-2"></span>Kembali
        </a>
    </div>
    <div class="col-md-9 col-12">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Kelola Mahasiswa/ </span>
            Input Nilai Mahasiswa
        </h4>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form class="default-form" action="{{ route('kelola_magang_pemb_lapangan.store_nilai', $mhs_magang->id_mhsmagang) }}" function-callback="afterAction">
            @csrf
            <div class="table-responsive table-bordered">
                <table class="table table-striped" id="table-input">
                    <thead>
                        <tr>
                            <th style="text-align: center;">NO</th>
                            <th style="min-width:230px;">ASPEK PENILAIAN</th>
                            <th style="min-width:230px;">DESKRIPSI ASPEK PENILAIAN</th>
                            <th style="min-width:100px;">NILAI MAX</th>
                            <th style="min-width:150px;">NILAI MAGANG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_nilai as $key => $item)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $item->aspek_penilaian }}</td>
                            <td>{{ $item->deskripsi_penilaian }}</td>
                            <td>{{ $item->nilai_max }}</td>
                            <td>
                                <input type="hidden" name="id_kompnilai[{{ $key }}]" value="{{ $item->id_kompnilai }}">
                                <div class="form-group">
                                    <input type="text" name="nilai[{{ $key }}]" class="form-control nilai-input" placeholder="85" value="{{ $item->nilai ?? '' }}"/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <th class="text-center" colspan="4">TOTAL NILAI AKHIR MAGANG</th>
                            <th class=""><input type="text" id="nilai-akhir" class="form-control" placeholder="-" style="max-width: 150px;" disabled /></th>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="4">PREDIKAT INDEX NILAI AKHIR MAGANG</th>
                            <th class=""><input type="text" id="index-nilai" class="form-control" placeholder="-" style="max-width: 150px;" disabled /></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="button" id="btn-submit-form" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Alert-->
<div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../../app-assets/img/alert.png" alt="">
                <h5 class="modal-title" id="modal-title">Apakah data yang anda input sudah benar?</h5>
                <p>Harap pastikan bahwa data yang Anda input sudah benar!</p>
            </div>
            <div class="modal-footer" style="display: flex; justify-content:center;">
                <button type="submit" id="modal-button" class="btn btn-success">Ya, yakin</button>
                <button type="submit" id="modal-button" class="btn btn-danger">Batal</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        getIndexNilai();
    });

    $(document).on('click', '#btn-submit-form', function () {
        sweetAlertConfirm({
            title: 'Apakah data yang anda input sudah benar?',
            text: 'Harap pastikan bahwa data yang Anda input sudah benar!',
            icon: 'warning',
            confirmButtonText: 'Ya, yakin',
            cancelButtonText: 'Batal'
        }, function () {
            let form = $('.default-form');
            form.find('#btn-submit-form').attr('type', 'submit');
            form.submit();
            form.find('#btn-submit-form').attr('type', 'button');
        });
    });

    $(document).on('keyup', '.nilai-input', function () {
        getIndexNilai();
    });

    function getIndexNilai() {
        let nilaiMutu = @json($nilai_mutu);
        let totalNilai = 0;

        $('.nilai-input').each(function () {
            if ($(this).val() != '' && $(this).val() != null) {
                totalNilai += parseFloat($(this).val());
            }
        });

        let index = nilaiMutu.find(item => totalNilai >= item.nilaimin && totalNilai <= item.nilaimax)?.nilaimutu;

        if (index != null && index != undefined) {
            $('#nilai-akhir').val(totalNilai);
            $('#index-nilai').val(index);
        } else {
            $('#nilai-akhir').val('-');
            $('#index-nilai').val('-');
        }
    }

    function afterAction(response) {
        setTimeout(() => {
            window.location.href = "{{ route('kelola_magang_pemb_lapangan') }}"; 
        }, 1500);
    }
</script>
@endsection