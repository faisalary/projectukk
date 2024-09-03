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
            @if (request()->has('lamaran') && request()->lamaran != null)
                <a href="{{ 'apply-lowongan/lamar/'.request()->lamaran }}" class="btn btn-outline-primary mb-4">
                    <i class="ti ti-arrow-left me-2 text-primary"></i>
                    Kembali ke lamaran
                </a>
            @endif
            <div class="row">
                <div class="col-6 pe-5">
                    <h4>Profil Saya</h4>
                </div>
                <div class="col-4 ps-5 pe-0" id="percentage_container">
                    @include('profile.components.percentage')
                </div>
                <!-- untuk unduh profile, diarahkan ke halaman unduh-profile/{nim} -->
                <div class="col-2 text-end ps-0">
                  <button id="unduhProfileBtn" class="btn btn-secondary buttons-collection btn-label-success ms-4 mt-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">
                    <span>
                      <i class="ti ti-download me-sm-1"></i> 
                      <span class="d-none d-sm-inline-block">Unduh CV</span>
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

    const ids = ["citizenships", "countries", "provinces", "id_kota"];
    ids.forEach(function(item) {
        if (item != "id_kota") {
            $('#' + item).on('change', function() {
                var value = $(this).val();
                var type = item;
                var targetId = $(this).data('target-dropdown');

                if(value != '' && value != null) {
                $.ajax({
                    url: `{{ route('wilayah.child') }}`,
                    data: {
                        type: type,
                        id: value,
                        '_token': '{{ csrf_token() }}'
                    },
                    method: 'POST',
                    success: function(data) {
                        var options = data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            };
                        });
                        options.unshift({
                            id: '',
                            text: 'Pilih'
                        });
                        $(targetId).empty();
                        initSelect2(targetId, options);

                        if (type === 'citizenships' && value === 'WNI') {
                            $('#countries').val(1).trigger('change');
                            $('#countries').prop('disabled', true);
                        } else if (type === 'citizenships' && value === 'WNA') {
                            $('#countries').val('').trigger('change').prop('disabled', false);
                            $('#kota_id, #provinces').val('').trigger('change').prop('disabled', true).empty();
                        } else if (type === 'countries' && value != '') {
                            $('#provinces').val('').trigger('change').prop('disabled', false);
                            $('#kota_id').val('').trigger('change').prop('disabled', true).empty();
                        } else if (type === 'provinces' && value != '') {
                            $('#kota_id').val('').trigger('change').prop('disabled', false);
                        }
                    }
                });
                }
            });
        }
    });
  });

  $('#changePicture').on('change', function (event) {
      let file = event.target.files[0];
      if (file) {
          $('#imgPreview2').attr('src', URL.createObjectURL(file));
      } else {
          $('#imgPreview2').attr('src', "{{ asset('app-assets/img/avatars/user.png') }}");
      }
  });

  function removeImage() {
      $('#formEditInformasi').find('input[name="remove_image"]').remove();
      $('#formEditInformasi').prepend(`<input type="hidden" name="remove_image" value="1">`);
      $('#imgPreview2').attr('src', "{{ asset('app-assets/img/avatars/user.png') }}");
  }

  $('#modalEditInformasi').on('hide.bs.modal', function () {
      $('#formEditInformasi').find('input[name="remove_image"]').remove();
      let defaultSrc = $('#imgPreview2').attr('default-src');
      $('#imgPreview2').attr('src', defaultSrc);
  });

  function afterUpdateDetailInfo(response) {
    response = response.data
    let resourceGambar = response.image ?? "{{ asset('app-assets/img/avatars/user.png') }}";
    $('#imgPreview2').attr('src', resourceGambar);
    $('#imgPreview2').attr('default-src', resourceGambar);
    $('#container-info-detail').html(response.view)
    $('#modalEditInformasi').modal('hide');
    updatePercentage()
  }

  function afterActionInfoTambahan(response) {
    response = response.data
    $('#container-informasi-tambahan').html(response.view)
    $('#modalEditInformasiTambahan').modal('hide');
    updatePercentage()
  }

  function afterActionEducation(response) {
    $('#modalTambahPendidikan').modal('hide');
    afterDeletePendidikan(response);
    updatePercentage()
  }

  function afterDeletePendidikan(response) {
    $('#container-pendidikan').html(response.data.view);
    updatePercentage()
  }

  function afterActionSkill(response) {
    $('#modalTambahKeahlian').modal('hide');
    $('#container-keahlian').html(response.data.view);
    updatePercentage()
  }

  function afterActionExperience(response) {
    $('#modalTambahPengalaman').modal('hide');
    afterDeleteExperience(response);
    updatePercentage()
  }

  function afterDeleteExperience(response) {
    $('#container-pengalaman').html(response.data.view);
    updatePercentage()
  }

  function afterActionDokumen(response) {
    $('#modalTambahDokumen').modal('hide');
    afterDeleteDokumen(response);
    updatePercentage()
  }

  function afterDeleteDokumen(response) {
    $('#container-dokumen-pendukung').html(response.data.view);
    updatePercentage()
  }

function updatePercentage() {
   $.ajax({
      url: `{{ route('profile.percentage') }}`,
      method: 'GET',
      success: function (response) {
        $('#percentage_container').html(response.data.view);
        $(function () {
          $('[data-bs-toggle="tooltip"]').tooltip()
        })
      }
    });
}

  $('.modal').on('hide.bs.modal', function () {
    let modalTitle = $(this).find('.modal-title');
    if (modalTitle.attr('data-label-default') !== undefined) modalTitle.html(modalTitle.attr('data-label-default'));
    $(this).find('form').find('input[name="data_id"]').remove();
    $(this).find('form').find('a[id="sertif_open"]').unwrap();
    $(this).find('form').find('a[id="sertif_open"]').remove();
    $('#countries').prop('disabled', true).empty();
    $('#provinces').prop('disabled', true).empty();
    $('#kota_id').prop('disabled', true).empty();
    formRepeaterCustom.find('[data-repeater-item]').slice(1).empty();    
  });

  document.getElementById('unduhProfileBtn').addEventListener('click', function() {
    var nim = '{{ $mahasiswa->nim }}';
    window.open('/unduh-profile/' + nim, '_blank');
  });
</script>

@include('profile/edit_delete_js')
@endsection
