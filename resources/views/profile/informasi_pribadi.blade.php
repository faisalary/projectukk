@extends('partials.horizontal_menu')

@section('page_style')
    <link rel="stylesheet" href="{{ url('assets/css/yearpicker.css') }}" />

    <style>
        .hidden {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="sec-title mt-4 mb-4">
            <div class="row">
                <div class="col-6 pe-5">
                    <h4>Profil Saya</h4>
                </div>
                <div class="col-4 ps-5 pe-0">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-start">Kelengkapan Profil</h6>
                        <h6 class="text-end" id="percentage_progress">0%</h6>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" id="progress_bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <!-- untuk unduh profile, diarahkan ke halaman unduh-profile/{nim} -->
                <div class="col-2 text-end ps-0">
                  <button id="unduhProfileBtn" class="btn btn-secondary buttons-collection btn-label-success ms-4 mt-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">
                    <span>
                      <i class="ti ti-download me-sm-1"></i> 
                      <span class="d-none d-sm-inline-block">Unduh Profile</span>
                    </span>
                  </button>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0" id="container-info-detail">
                <!-- User Profile-->
                @include('profile.components.informasi_pribadi_detail')
            </div>

            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- User Pills -->
                @include('profile.components.tab_profile')
                <!--/ User Pills -->
                <!-- Content -->
                <div class="tab-content p-0">
                    <!-- Informasi Tambahan -->
                    @include('profile.components.informasi_tambahan')
                    <!-- /Informasi Tambahan -->

                    <!-- <pendidikan> -->
                    @include('profile.components.pendidikan')
                    <!-- </pendidikan> -->

                    <!-- <Keahlian&Pengalaman> -->
                    @include('profile.components.keahlian')
                    <!-- </Keahlian&Pengalaman> -->

                    <!-- <Dokumen Pendukung> -->
                    @include('profile.components.dokumen_pendukung')
                </div>
                <!-- </Content> -->
            </div>
        </div>
    </div>

    @include('profile.components.modal')
@endsection

@section('page_script')
<script>
  let formRepeaterCustom;
  $(document).ready(function () {
    formRepeaterCustom = initFormRepeaterCustom();

    // $.ajax({
    //   url: `{{ route('profile.get_data') }}`,
    //   type: 'GET',
    //   data: { section: 'completeness_percentage' },
    //   success: function (response) {
    //     $('#progress_bar').css('width', response.data.percentage + '%');
    //     $('#progress_bar').attr('aria-valuenow', response.data.percentage);
    //     $('#percentage_progress').text(response.data.percentage + '%');
    //   }
    // });

  });

  function afterUpdateDetailInfo(response) {
    response = response.data
    $('#container-info-detail').html(response.view)
    $('#modalEditInformasiTambahan').modal('hide');
  }

  function afterActionInfoTambahan(response) {
    response = response.data
    $('#container-informasi-tambahan').html(response.view)
    $('#modalEditInformasiTambahan').modal('hide');
  }

  function afterActionEducation(response) {
    $('#modalTambahPendidikan').modal('hide');
    afterDeletePendidikan(response);
  }

  function afterDeletePendidikan(response) {
    $('#container-pendidikan').html(response.data.view);
  }

  function afterActionSkill(response) {
    $('#modalTambahKeahlian').modal('hide');
    $('#container-keahlian').html(response.data.view);
  }

  function afterActionExperience(response) {
    $('#modalTambahPengalaman').modal('hide');
    afterDeleteExperience(response);
  }

  function afterDeleteExperience(response) {
    $('#container-pengalaman').html(response.data.view);
  }

  function afterActionDokumen(response) {
    $('#modalTambahDokumen').modal('hide');
    afterDeleteDokumen(response);
  }

  function afterDeleteDokumen(response) {
    $('#container-dokumen-pendukung').html(response.data.view);
  }

  $('.modal').on('hide.bs.modal', function () {
    let modalTitle = $(this).find('.modal-title');
    if (modalTitle.attr('data-label-default') !== undefined) modalTitle.html(modalTitle.attr('data-label-default'));
    $(this).find('form').find('input[name="data_id"]').remove();
    $(this).find('form').find('a[id="sertif_open"]').unwrap();
    $(this).find('form').find('a[id="sertif_open"]').remove();
  });

  document.getElementById('unduhProfileBtn').addEventListener('click', function() {
    var nim = '{{ $mahasiswa->nim }}';
    window.open('/unduh-profile/' + nim, '_blank');
  });
</script>

@include('profile/edit_delete_js')
@endsection
