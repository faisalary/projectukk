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


        #tabs .nav-tabs{
            background-color: transparent;
            margin-bottom: 2rem;
            border: none;
        }

        #aside-profile-dosen .active{
            background-color:#4ea971 ;
            color: white;
            border: 1px solid #4ea971;
            box-shadow:0;
        }
        
        #aside-profile-dosen .active .text-no{
            background-color:#DCEEE3;
            color: #4ea971;
            border-radius: 100%;
            box-shadow:0;
            width: 1.5rem;
            height: 1.5rem;
            margin-left: 0.7rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #aside-profile-dosen .text-no{
            background-color:#D3D6DB;
            color: #485369;
            border-radius: 100%;
            box-shadow:0;
            width: 1.5rem;
            height: 1.5rem;
            margin-left: 0.7rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #tabs .nav-tabs .nav-link .active{
            box-shadow: 0 -2px 0 #4ea971 insert
        }

        #tabs .nav-tabs .nav-link .active {
            box-shadow: 0 -2px 0 transparent inset;
        }

        #aside-profile-dosen .nav-item{
            border: none;
            outline: none;
            margin-bottom: 1rem;
        }

        #aside-profile-dosen .nav-link, #aside-profile-dosen .nav-item{
            border: none;
            outline: none;
        }

        #aside-profile-dosen .nav-link:hover{
            color: #4ea971;
            background-color: rgba(0, 0, 0, 0.079);
        }

        #tabs .nav-tabs .nav-link .active:hover{
            color: white;
        }

        #aside-profile-dosen .active:hover {
            background-color: #4ea971;
            color: white;
            /* border: 1px solid #4ea971; */
            /* border-radius: 10%; */
            box-shadow: 0;
        }
    </style>
@endsection

@section('content')
        <div id="tabs" style="display: flex; flex-direction: column;  gap:1rem;">
            <div id="aside-profile-dosen" class="list-group py-3 d-flex flex-row gap-2 nav nav-pills align-items-center px-3" style="height: max-content; width: max-content;" role="tablist" aria-orientation="vertical">
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
            <div class="tab-content" id="v-pills-tabContent" style="width: 100%;">
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
      
    });

    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        const svgVisible = `<svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 5C10.2044 5 9.44129 5.31607 8.87868 5.87868C8.31607 6.44129 8 7.20435 8 8C8 8.79565 8.31607 9.55871 8.87868 10.1213C9.44129 10.6839 10.2044 11 11 11C11.7956 11 12.5587 10.6839 13.1213 10.1213C13.6839 9.55871 14 8.79565 14 8C14 7.20435 13.6839 6.44129 13.1213 5.87868C12.5587 5.31607 11.7956 5 11 5ZM11 13C9.67392 13 8.40215 12.4732 7.46447 11.5355C6.52678 10.5979 6 9.32608 6 8C6 6.67392 6.52678 5.40215 7.46447 4.46447C8.40215 3.52678 9.67392 3 11 3C12.3261 3 13.5979 3.52678 14.5355 4.46447C15.4732 5.40215 16 6.67392 16 8C16 9.32608 15.4732 10.5979 14.5355 11.5355C13.5979 12.4732 12.3261 13 11 13ZM11 0.5C6 0.5 1.73 3.61 0 8C1.73 12.39 6 15.5 11 15.5C16 15.5 20.27 12.39 22 8C20.27 3.61 16 0.5 11 0.5Z" fill="#535353"/></svg>`;

        const svgHidden = `<svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.83 6L14 9.16V9C14 8.20435 13.6839 7.44129 13.1213 6.87868C12.5587 6.31607 11.7956 6 11 6H10.83ZM6.53 6.8L8.08 8.35C8.03 8.56 8 8.77 8 9C8 9.79565 8.31607 10.5587 8.87868 11.1213C9.44129 11.6839 10.2044 12 11 12C11.22 12 11.44 11.97 11.65 11.92L13.2 13.47C12.53 13.8 11.79 14 11 14C9.67392 14 8.40215 13.4732 7.46447 12.5355C6.52678 11.5979 6 10.3261 6 9C6 8.21 6.2 7.47 6.53 6.8ZM1 1.27L3.28 3.55L3.73 4C2.08 5.3 0.78 7 0 9C1.73 13.39 6 16.5 11 16.5C12.55 16.5 14.03 16.2 15.38 15.66L15.81 16.08L18.73 19L20 17.73L2.27 0M11 4C12.3261 4 13.5979 4.52678 14.5355 5.46447C15.4732 6.40215 16 7.67392 16 9C16 9.64 15.87 10.26 15.64 10.82L18.57 13.75C20.07 12.5 21.27 10.86 22 9C20.27 4.61 16 1.5 11 1.5C9.6 1.5 8.26 1.75 7 2.2L9.17 4.35C9.74 4.13 10.35 4 11 4Z" fill="#535353"/></svg>`;
        
        const passwordInputs = document.querySelectorAll('input[type="password"]');
                
        toggleButtons.forEach(button => {
            const input = button.previousElementSibling;
            button.style.display = 'none'
            // Add input event listener to show/hide button based on input content
            input.addEventListener('input', function() {
                button.style.display = this.value ? 'block' : 'none';
            });

            button.addEventListener('click', function() {
                if (input.type === 'password') {
                    input.type = 'text';
                    this.innerHTML = svgVisible;
                } else {
                    input.type = 'password';
                    this.innerHTML = svgHidden;
                }
            });
        });
    });
</script>
@endsection