@extends('partials.horizontal_menu')

@section('page_style')
    <link rel="stylesheet" href="{{ url('assets/css/yearpicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css') }}">

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
                        <h6 class="text-end">20%</h6>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-2 text-end ps-0">
                    <button class="btn btn-secondary buttons-collection  btn-label-success ms-4 mt-2" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog"
                        aria-expanded="false"><span><i class="ti ti-download me-sm-1"></i> <span
                                class="d-none d-sm-inline-block">Unduh Profile</span></span></button>
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
  $(document).ready(function () {

  });

  function afterUpdateDetailInfo(response) {
    response = response.data
    $('#container-info-detail').html(response.view)
    $('#modalEditInformasi').modal('hide');
  }

  function editInfoProfile() {
    let modal = $('#modalEditInformasi');
    modal.modal('show');

    $.ajax({
      url: `{{ route('profile.get_data') }}`,
      type: 'GET',
      success: function (response) {
        response = response.data;

        $.each(response, function (key, value) {
          let element = modal.find(`[name="${key}"]`);
          if (element.is(':radio')) {
            modal.find(`[name="${key}"][value="${value}"]`).prop('checked', true);
          } else {
            if (element.hasClass('flatpickr-date')) {
              element.flatpickr({
                  altInput: true,
                  altFormat: 'j F Y',
                  dateFormat: 'Y-m-d',
                  defaultDate: value
              });
            }
            element.val(value);
          }
        });
      }
    });
  }

</script>
@endsection
