@php
    $user = Auth::user();
@endphp
@extends('partials.vertical_menu')
@section('page_style')
    <style>
        #profile .text-secondary{
            font-weight: 500;
        }
        /* #aside-profile-dosen .nav-link.active{
            background: linear-gradient(72.47deg, #4EA971 22.16%, rgba(78, 169, 113, 0.7) 76.47%);
        } */
        #field-change-password input{
            height: 2.5rem;
            width: 20rem;
            border-radius: 0.375rem;
            border: 1px solid rgba(0, 0, 0, 0.393);
        }
        .nav-pills .nav-link.active, .nav-pills .nav-link.active:hover, .nav-pills .nav-link.active:focus span{
            color: white;
        }

        #aside-profile-dosen .nav-link.active svg path {
            stroke: #ffffff;
        }
        #aside-profile-dosen .nav-link.active svg circle {
            stroke: #ffffff;
        }
    </style>
@endsection

@section('content')
        <div style="display: flex; align-items: flex-start; gap:1rem;">
            <div id="aside-profile-dosen" class="card list-group py-3 d-flex flex-column gap-2 nav nav-pills align-items-center px-2" style="height: 26.7rem;" role="tablist" aria-orientation="vertical">
                <button id="v-pills-informasi-pribadi-tab" class="border-none rounded d-flex flex-row align-items-center justify-content-around nav-link active" data-bs-toggle="pill" data-bs-target="#v-pills-informasi-pribadi" type="button" role="tab" aria-controls="v-pills-informasi-pribadi" aria-selected="true" style="width: 14rem; height: 3rem;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 6H19C19.5523 6 20 6.44772 20 7V18C20 19.1046 19.1046 20 18 20C16.8954 20 16 19.1046 16 18V5C16 4.44772 15.5523 4 15 4H5C4.44772 4 4 4.44772 4 5V17C4 18.6569 5.34315 20 7 20H18" stroke="#4B465C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 6H19C19.5523 6 20 6.44772 20 7V18C20 19.1046 19.1046 20 18 20C16.8954 20 16 19.1046 16 18V5C16 4.44772 15.5523 4 15 4H5C4.44772 4 4 4.44772 4 5V17C4 18.6569 5.34315 20 7 20H18" stroke="white" stroke-opacity="0.2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 8H12" stroke="#4B465C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 8H12" stroke="white" stroke-opacity="0.2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 12H12" stroke="#4B465C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 12H12" stroke="white" stroke-opacity="0.2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 16H12" stroke="#4B465C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 16H12" stroke="white" stroke-opacity="0.2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Informasi Pribadi</span>
                </button>
                <button id="v-pills-ubah-password-tab" class="border-none rounded d-flex flex-row align-items-center justify-content-around nav-link" data-bs-toggle="pill" data-bs-target="#v-pills-ubah-password" type="button" role="tab" aria-controls="v-pills-ubah-password" aria-selected="false"  style="width: 14rem; height: 3rem;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="8" cy="15" r="4" stroke="#4B465C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.8496 12.15L18.9996 4" stroke="#4B465C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18 5L20 7" stroke="#4B465C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15 8L17 10" stroke="#4B465C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Ubah Password</span>
                </button>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                @include('profile.detail-profile-dosen&mitra.profile-content')
                @include('profile.detail-profile-dosen&mitra.ubah-password')
            </div>
        </div>
@endsection

@section('page_script')
<script>
    function getDataSelect(e) {
        let idElement = e.attr('data-after');
        let modalId = e.closest('.modals').attr('id');
        console.log(idElement, modalId)
        $.ajax({
            url: `{{ route('profile_detail.informasi-pribadi') }}?type=${idElement}&selected=` + e.val(),
            type: 'GET',
            success: function (response) {
                $(`#${modalId} #${idElement}`).find('option:not([disabled])').remove();
                $(`#${modalId} #${idElement}`).val(null).trigger('change');
                $.each(response.data, function () {
                    $(`#${modalId} #${idElement}`).append(new Option(this.text, this.id));
                });
            }
        });
    }

    function afterAction(response) {
        $('#largeModal').modal('hide');
    }

    $("#largeModal").on("hide.bs.modal", function() {
        const univ = {{$dosen->namauniv}}
        const fakultas = {{$dosen->namafakultas}}
        const prodi = {{$dosen->namaprodi}}
        const nama = {{$dosen->namadosen}}
        const nohp = {{$dosen->nohpdosen}}
        const email = {{$dosen->emaildosen}}

        $('#id_univ').val(univ);

        $('#largeModal').modal('hide');
    });
</script>
@endsection