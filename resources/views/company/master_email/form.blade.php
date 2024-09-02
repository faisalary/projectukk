@extends('partials.vertical_menu')

@section('page_style')
<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/wvvl95lwerx43x4t222r07gfmtco2bj1lxolqeblms3wwj0v/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea#content_email',
    });
</script>
<style>
    .tooltip-inner {
        max-width: 450px !important;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-start">
    <a href="{{ route('template_email') }}" class="btn btn-outline-primary"><i class="ti ti-arrow-left me-2"></i>Kembali</a>
</div>
<div class="d-flex justify-content-start mt-3">
    <h4 class="mb-0">Template Email</h4>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="default-form" action="{{ route('template_email.store') }}" function-callback="afterAction">
                    @csrf
                    <input type="hidden" name="proses" value="{{ $proses }}">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="proses">Proses</label>
                            <input class="form-control" type="text" name="proses" id="proses" placeholder="Proses" value="{{ $proses_name }}" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 form-group mt-3">
                            <label for="subject_email">Subjek Email</label>
                            <input class="form-control" type="text" name="subject_email" id="subject_email" value="{{ $existing->subject_email ?? '' }}" placeholder="Subjek Email">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 form-group mt-3">
                            <label for="">Tag Tersedia</label>
                            <div class="d-flex justify-content-start mt-1">
                                <i class="ti ti-info-circle text-info"></i>&ensp;
                                Anda bisa menggunakannya untuk kebutuhan penulisan isi email
                            </div>
                            <div class="demo-inline-spacing mb-2">
                                @foreach ($list_tag as $item)
                                <button type="button" onclick="insert_shortcode($(this))" data-shortcode="{{ $item['shortCode'] }}"
                                    class="mx-2 btn btn-xs btn-primary">
                                    {{ $item['title'] }}
                                </button>
                                @endforeach
                            </div>
                            <textarea class="form-control mt-3" name="content_email" id="content_email" rows="4">{{ $existing->content_email ?? '' }}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 text-end mt-5">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        $('#submit').prop('disabled', false);
    });
    function insert_shortcode(e) {
        tinymce.activeEditor.execCommand('mceInsertContent', false, e.data('shortcode'));
    }

    function afterAction(response) {

        setTimeout(() => {
            window.location.href = "{{ route('template_email') }}";       
        }, 1500);
    }
</script>
@endsection