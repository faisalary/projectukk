@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="d-flex justify-content-start">
    <a href="{{ $urlBack }}" class="btn btn-outline-primary">
        <i class="ti ti-arrow-left"></i>&ensp;
        Kembali
    </a>
</div>
<div class="d-flex justify-content-start mt-3">
    <h4><span class="text-muted">Approval Mahasiswa</span>&ensp;/&ensp;Detail Mahasiswa</h4>
</div>

<div class="row">
    <div class="col-12">
        @include('mahasiswa/card_detail_mhs')
    </div>
</div>
@endsection

@section('page_script')
<script>
    
</script>
@endsection
