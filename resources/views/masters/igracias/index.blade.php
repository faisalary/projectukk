@extends('partials.vertical_menu')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
<style>
    .capitalize-title {
  text-transform: capitalize;
}
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Igracias</h4>
        </div>       
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-3 " role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-dosen" aria-controls="navs-pills-justified-dosen"
                        aria-selected="true">
                        Dosen
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" id="mata_kuliah-tab"
                        data-bs-target="#navs-pills-justified-mata_kuliah" aria-controls="navs-pills-justified-mata_kuliah"
                        aria-selected="false">
                        Mata Kuliah
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" id="mahasiswa-tab"
                        data-bs-target="#navs-pills-justified-mahasiswa" aria-controls="navs-pills-justified-mahasiswa"
                        aria-selected="false">
                        Mahasiswa
                    </button>
                </li>
            </ul>
            <div class="tab-content p-0">
                <div class="col-md-12 d-flex justify-content-end mt-2 pt-2" style="padding-right: 1rem;">
                    {{-- <p class="text-secondary">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Universitas : -, Fakultas : -, Prodi : -" id="tooltip-filter"></i></p> --}}
                    <div class="btn-group">
                        <button type="button" class="btn btn-success tambah-dropdown-toggle dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            Tambah Dosen
                        </button>
                        <ul class="dropdown-menu" style="">                           
                            <li>
                                <a class="dropdown-item btn text-success d-block pe-15" data-bs-toggle="modal" data-bs-target="#modal-dosen-import">
                                    <i class="ti ti-upload me-2"></i> <!-- Add `me-2` class for margin-end -->
                                    Import Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item btn text-success d-block pe-15" onclick="sinkronisasiData();">
                                    <i class="ti ti-reload me-2"></i> <!-- Add `me-2` class for margin-end -->
                                    Sinkronisasi Data
                                </a>
                            </li>
                            <li>                               
                                <a class="dropdown-item btn text-success" data-bs-toggle="modal" data-bs-target="#modal-dosen">
                                    <i class="ti ti-plus me-2"></i> <!-- Add `me-2` class for margin-end -->
                                    Tambah Dosen
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @foreach (['dosen', 'mata_kuliah', 'mahasiswa'] as $key => $item)
                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="navs-pills-justified-{{ $item }}" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="{{ $item == 'mata_kuliah' ? 'mata-kuliah' : $item }}">
                            <thead>
                                <tr>
                                    @foreach ($view[$item] as $item)
                                        {!! $item !!}
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>        
    </div>

    <!-- Modal -->

@include('masters.igracias.dosen.modal')
@include('masters.igracias.mata-kuliah.modal')
@include('masters.igracias.mahasiswa.modal')
@endsection

@section('page_script')
    <script>
        $(document).ready(function () {
            loadData('dosen');
        });

        function getDataSelect(e) {
            let idElement = e.attr('data-after');
            let modalId = e.closest('.modals').attr('id');

            $(`#${modalId} #${idElement}`).find('option:not([disabled])').remove();
            $(`#${modalId} #${idElement}`).val(null).trigger('change');

            if (e.val() == null) return;
            
            $.ajax({
                url: `{{ route('igracias') }}?type=${idElement}&selected=` + e.val(),
                type: 'GET',
                success: function (response) {
                    $.each(response.data, function () {
                        $(`#${modalId} #${idElement}`).append(new Option(this.text, this.id));
                    });
                }
            });
        }
       
        function loadData(tab = null) {            
            let columns = [];
            let url = '';

            switch (tab) {
                case 'dosen':
                    columns = {!! $view['columnsDosen'] !!};
                    url = `{{ $view['getRoute']('dosen', 'show') }}`;
                    break;
                case 'mata-kuliah':
                     columns = {!! $view['columnsMataKuliah'] !!};
                    url = `{{ $view['getRoute']('matakuliah', 'show') }}`;
                    break;
                case 'mahasiswa':
                    columns = {!! $view['columnsMahasiswa'] !!};
                    url = `{{ $view['getRoute']('mahasiswa', 'show') }}`;
                    break;
            }

            let table = $('#' + tab).DataTable({
                ajax: {
                    url: url,
                    type: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: function (d) {
                        const frm_data = $('#filter' + tab).serializeArray();
                        $.each(frm_data, function (key, val) {
                            d[val.name] = val.value;
                        });
                    }
                },
                serverSide: true,
                processing: true,
                destroy: true,
                scrollX: true,
                columns: columns
            });
        }
       
        // modal variable
        let buttonText = 'Dosen';
        let lowerCaseButtonText = 'dosen';      
        let modalTarget = `"#modal-${lowerCaseButtonText}"` 

        function edit(e) {
            let id = e.attr('data-id');
            let action = '';
            let url = '';

            switch (lowerCaseButtonText) {
                case 'dosen':
                    action = `{{ $view['getRoute']('dosen', 'update') }}`;
                    url = `{{ $view['getRoute']('dosen', 'edit') }}`;
                    break;
                case 'mata-kuliah':
                    action = `{{ $view['getRoute']('matakuliah', 'update') }}`;
                    url = `{{ $view['getRoute']('matakuliah', 'edit') }}`;
                    break;
                case 'mahasiswa':
                    action = `{{ $view['getRoute']('mahasiswa', 'update') }}`;
                    url = `{{ $view['getRoute']('mahasiswa', 'edit') }}`;
                    break;
            }
           
            let modal = $(`#modal-${lowerCaseButtonText}`);
            let form = modal.find('form');

            modal.find(".modal-title").html(`Edit ${lowerCaseButtonText.replace(/-/g, ' ')}`);
            form.find('button[type="submit"]').html("Update Data")
            form.attr('action', action.replace(':id', id));
            modal.modal('show');

            $.ajax({
                type: 'GET',
                url: url.replace(':id', id),
                success: function(response) {                                           
                    const responseKeys = response.data ? response.data : response    
                    $.each(responseKeys, function ( key, value ) {                    
                        let element = form.find(`[name="${key}"]`);                        
                        if (element.is('select') && element.find('option').length <= 1) {
                            let interval = setInterval(() => {
                                if (element.children('option').length > 1) {
                                    element.val(value).trigger('change');
                                    clearInterval(interval);
                                }
                            }, 100);
                        } else if (element.is('[type="radio"]')) {
                            $(`[name="${key}"][value="${value}"]`).prop("checked", true);
                        } else {
                            element.val(value).trigger('change');
                        }
                    });
                }
            });
        }       

        function afterUpdateStatus(response) {
            sinkronisasiData();
        }

        function sinkronisasiData() {
            $('#' + lowerCaseButtonText).DataTable().ajax.reload();
        }

        function afterAction(response) {
            $(`#modal-${lowerCaseButtonText}, #modal-import-${lowerCaseButtonText}`).modal('hide');
            afterUpdateStatus(response);
        }

        let tabs = ['dosen', 'mata-kuliah', 'mahasiswa'];

        tabs.forEach((item) => {  
        console.log(item)                      
            $("#modal-" + item).on("hide.bs.modal", function() {               
                $(this).find("#modal-title").html(`Tambah ${lowerCaseButtonText.replace(/-/g, ' ')}`);
            });
        })

        
        // load data once variable 
        const tabClicked = {
            'dosen': true,
            'mata-kuliah': false,
            'mahasiswa': false
        };

        function handleTabClick(tabName) {
            if (!tabClicked[tabName]) {
                tabClicked[tabName] = true;
                loadData(tabName);
            }
        }

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {                                                
            buttonText = $(this).text().trim();  
            lowerCaseButtonText = buttonText.toLowerCase().replace(/\s+/g, '-');               
            $(`a[data-bs-target=${modalTarget}]`).attr('data-bs-target', `#modal-${lowerCaseButtonText}`)                        
            $(`a[data-bs-target=${modalTarget.slice(0, -1) + '-import' + modalTarget.slice(-1)}]`).attr('data-bs-target', `#modal-${lowerCaseButtonText}-import`)                  
            modalTarget = `'#modal-${lowerCaseButtonText}'`                           
            $('.tambah-dropdown-toggle').text(`Tambah ${buttonText}`);             
            const dropDownBtn = $(`a[data-bs-target=${modalTarget}]`);
            dropDownBtn.html(`<i class="ti ti-plus me-2"></i>Tambah ${buttonText}`); 
            handleTabClick(lowerCaseButtonText);            

            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
        });
    </script>
@endsection
