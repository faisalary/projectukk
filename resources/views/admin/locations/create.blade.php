@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">@lang('app.createNew')</h4>

                    <form class="ajax-form" method="POST" id="createForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-9">

                                <div class="form-group">
                                    <label for="address">@lang('app.country')</label>
                                    <select name="country_id" id="country_id"
                                            class="form-control select2 custom-select">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ ucfirst($country->country_name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div id="education_fields">
                            <div class="row">
                                <div class="col-sm-9 nopadding">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="locations[]" id="form-input" class="form-control"
                                                    placeholder="@lang('menu.locations') @lang('app.name')">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="add-more">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="save-form" class="btn btn-success"><i
                                    class="fa fa-check"></i> @lang('app.save')</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-script')
    <script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"
            type="text/javascript"></script>
    <script>
        // For select 2
        $(".select2").select2();

        var room = 1;

        $('#add-more').click(function () {
            room++;

            var divtest = `
                <div class="row removeclass${room}">
                    <div class="col-sm-9 nopadding">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="locations[]" class="form-control" placeholder="@lang('menu.locations') @lang('app.name')">
                                <div class="input-group-append"> 
                                    <button class="btn btn-danger" type="button" onclick="remove_education_fields(${room});">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>`;

            $('#education_fields').append(divtest);
            $(`.removeclass${room} input`).focus();
        })

        function remove_education_fields(rid) {
            $('.removeclass' + rid).remove();
        }

        $('#save-form').click(function () {
            $.easyAjax({
                url: '{{route('admin.locations.store')}}',
                container: '#createForm',
                type: "POST",
                redirect: true,
                data: $('#createForm').serialize()
            })
        });
        $('#form-input').keydown(function (e) {
            if (e.keyCode == 13) {
                jQuery('#save-form').focus().click();
                e.preventDefault();
        return false;
        }
    });
    </script>
@endpush