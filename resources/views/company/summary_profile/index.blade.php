@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h4>Summary Profile Perusahaan</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="d-flex justify-content-between border-bottom">
                        <h5 class="text-secondary my-auto">RINGKASAN PROFILE PERUSAHAAN</h5>
                        <a href="javascript:void(0)" class="btn-icon text-warning" onclick="edit();">
                            <i class="ti ti-edit"></i>
                        </a>
                    </div>
                    <div id="container-detail-profile">
                        @include('company/summary_profile/components/card_detail')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('company.summary_profile.modal')
@endsection

@section('page_script')
    <script>
        function afterAction(response) {
            $('#container-detail-profile').html(response.data.view)
            let resourceGambar = response.data.image ?? "{{ asset('app-assets/img/avatars/user.png') }}";
            $('#imgPreview2').attr('src', resourceGambar);
            $('#imgPreview2').attr('default-src', resourceGambar);
            $('#modalEditProfile').modal('hide');
        }

        $('#changePicture').on('change', function (event) {
            let file = event.target.files[0];
            if (file) {
                $('#imgPreview2').attr('src', URL.createObjectURL(file));
            } else {
                $('#imgPreview2').attr('src', "{{ asset('app-assets/img/avatars/user.png') }}");
            }
        });

        function removeImage() {
            $('.default-form').find('input[name="remove_image"]').remove();
            $('.default-form').prepend(`<input type="hidden" name="remove_image" value="1">`);
            $('#imgPreview2').attr('src', "{{ asset('app-assets/img/avatars/user.png') }}");
        }

        function edit() {
            $('#modalEditProfile').modal('show');
            $.ajax({
                url: `{{ route('profile_company.edit', ['id' => $industri->id_industri]) }}`,
                type: 'GET',
                success: function (response) {
                    $('#imgPreview2').attr('src', response.image);
                    $('#imgPreview2').attr('default-src', response.image);
                    $.each(response, function (key, value) {
                        $(`[name="${key}"]`).val(value).change();
                    });
                }
            });
        }

        $('#modalEditProfile').on('hide.bs.modal', function () {
            $('.default-form').find('input[name="remove_image"]').remove();
            let defaultSrc = $('#imgPreview2').attr('default-src');
            $('#imgPreview2').attr('src', defaultSrc);
        });
    </script>
@endsection
