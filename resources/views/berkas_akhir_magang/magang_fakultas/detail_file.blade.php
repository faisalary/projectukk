@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-start mb-3">
    <a href="{{ route('berkas_akhir_magang.fakultas') }}" class="btn btn-outline-primary">
        <i class="ti ti-arrow-left"></i>
        Kembali
    </a>
</div>
<div class="row">
    <div class="col-12">
        <canvas id="the-canvas" class="w-100" style="border:1px solid black;"></canvas>
    </div>
    <div class="col-12">
        
    </div>
</div>
@endsection

@section('page_script')
@include('berkas_akhir_magang/magang_fakultas/script_js_detail_file')

<script>

</script>
@endsection