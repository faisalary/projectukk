@extends('layouts.app')

@push('head-script')
    <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">    <link rel="stylesheet" href="{{ asset('assets/node_modules/html5-editor/bootstrap-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/multiselect/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/all.css') }}">

    <style>
        .mb-20{
            margin-bottom: 20px
        }
        .datepicker{
            z-index: 9999 !important;
        }
    </style>
@endpush

@section('content')

@if(request()->segment(2) == 'company')
@php
$company = App\Company::find(request()->segment(3));
$job = App\Job::find(request()->segment(4));
@endphp
<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2 d-flex align-items-center">
            <div class="col-md-5">
                <h1 class="mb-xs-2">{{ $job->title."'s ".$pageTitle }}</h1>
            </div>
            <div class="col-md-7">
                <span class="float-sm-right">@yield('create-button')</span>
                <ol class="breadcrumb float-sm-right mr-2 mt-xs-2">
                    <li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}"><i class="icon-home text-primary"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}/{{ request()->segment(3) }}">{{ $company->company_name }}</a></li>
                    <li class="breadcrumb-item active">{{ $job->title }}'s {{ $pageTitle }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row clearfix">
                    <div class="col-md-12 mb-20">
                        <a href="javascript:;" id="toggle-filter" class="btn btn-outline btn-success btn-sm toggle-filter"><i
                                    class="fa fa-sliders"></i> @lang('app.filterResults')</a>
                        <a href="{{ route('admin.company.job-applications').'/'.$company_id.'/'.$job_id }}" class="btn btn-outline btn-primary btn-sm">
                            <i class="fa fa-columns"></i> @lang('modules.jobApplication.boardView')
                        </a>
                        <a href="{{ route('admin.application-setting.index').'#mail-setting' }}" class="btn btn-sm btn-info">
                            <i class="fa fa-envelope-o"></i>
                            @lang('modules.applicationSetting.mailSettings')
                        </a>
                        {{-- <a class="pull-right" onclick="exportJobApplication()" ><button class="btn btn-sm btn-primary" type="button">
                                <i class="fa fa-upload"></i>  @lang('menu.export')
                            </button></a> --}}
                    </div>
                </div>
                <div class="row b-b b-t mb-3" style="display: none; background: #fbfbfb;" id="ticket-filters">
                    <div class="col-md-12">
                        <h4 class="mt-2">@lang('app.filterBy') <a href="javascript:;" class="pull-right toggle-filter"><i class="fa fa-times-circle-o"></i></a></h4>
                    </div>
                    <div class="col-md-12">
                        <form id="filter-form" class="row" >
                            <div class="col-md-4">
                                {{-- <label for="date-range">example</label> --}}
                                <div class="example">
                                    <div class="input-daterange input-group" id="date-range">
                                        <input type="text" class="form-control" id="start-date" placeholder="Show Results From" value="" autocomplete="off" />
                                        <span class="input-group-addon bg-info b-0 text-white p-1">@lang('app.to')</span>
                                        <input type="text" class="form-control" id="end-date" placeholder="Show Results To" value="" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="example">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="start-year" placeholder="Grad. Year From" autocomplete="off" />
                                        <span class="input-group-addon bg-info b-0 text-white p-1">@lang('app.to')</span>
                                        <input type="number" class="form-control" id="end-year" placeholder="Grad.Year To" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            {{--
                            <div class="col-md-4">
                                <div class="example">
                                    <div class="input-group">
                                        <input type="number" min="0" max="4" step="0.01" class="form-control" id="start-gpa" placeholder="GPA From" autocomplete="off" />
                                        <span class="input-group-addon bg-info b-0 text-white p-1">@lang('app.to')</span>
                                        <input type="number" min="0" max="4" step="0.01" class="form-control" id="end-gpa" placeholder="GPA To" autocomplete="off" />
                                    </div><br />
                                </div>
                            </div>
                            --}}
                            {{--
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="select2" name="status" id="status" data-style="form-control">
                                        <option value="all">@lang('modules.jobApplication.allStatus')</option>
                                        @forelse($boardColumns as $status)
                                            <option value="{{$status->id}}">{{ucfirst($status->status)}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="select2" name="jobs" id="jobs" data-style="form-control">
                                        <option value="all">@lang('modules.jobApplication.allJobs')</option>
                                        @forelse($jobs as $job)
                                            <option title="{{ucfirst($job->title)}}" value="{{$job->id}}">{{ucfirst($job->title)}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="select2" name="location" id="location" data-style="form-control">
                                        <option value="all">@lang('modules.jobApplication.allLocation')</option>
                                        @forelse($locations as $location)
                                            <option value="{{$location->id}}">{{ucfirst($location->location)}}</option>
                                        @empty
                                        @endforelse

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select class="select2" name="skill[]" data-placeholder="Select Skills" multiple="multiple" id="skill" data-style="form-control">
                                        @forelse($skills as $skill)
                                            <option value="{{$skill->id}}">{{ucfirst($skill->name)}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="button" id="apply-filters" class="btn btn-sm btn-success"><i class="fa fa-check"></i> @lang('app.apply')</button>
                                    <button type="button" id="reset-filters" class="btn btn-sm btn-dark"><i class="fa fa-refresh"></i> @lang('app.reset')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('modules.jobApplication.applicantName')</th>
                            <th>@lang('menu.jobs')</th>
                            <th>@lang('menu.locations')</th>
                            <th>@lang('app.status')</th>
                            <!-- <th>@lang('app.action')</th> -->
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-script')
    <script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="//cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="{{ asset('assets/node_modules/moment/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/node_modules/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

    <script>

        $('#start-date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        })
        $('#end-date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        })

        $('#start-date').datepicker().on('changeDate', function(e) {
            $('#end-date').datepicker('setStartDate', $(this).datepicker('getDate'));
        });

        $('#end-date').datepicker().on('changeDate', function(e) {
            $('#start-date').datepicker('setEndDate', $(this).datepicker('getDate'));
        });

        var table;
        tableLoad('load');
        // For select 2
        $(".select2").select2({
            width: '100%'
        });
        $('#reset-filters').click(function () {
            $('#filter-form')[0].reset();
            $('#filter-form').find('select').select2('render');
            tableLoad('load');
        })
        $('#apply-filters').click(function () {
            tableLoad('filter');
        });

        function tableLoad(type) {
            var status = '{{ request()->segment(6) }}';
            var jobs = @if(request()->segment(3) == 'table-view') $('#jobs').val(); @else '{{ request()->segment(5) }}'; @endif
            var location = $('#location').val();
            var startDate = $('#start-date').val();
            var endDate = $('#end-date').val();
            var startYear = $('#start-year').val();
            var endYear = $('#end-year').val();
            var startGpa = '';
            var endGpa = '';

            var company_id = '{{ $company_id }}';
            var job_id = '{{ $job_id }}';
            var url = "{!! route('admin.job-applications.data', [':company_id', ':job_id']) !!}?status="+status+'&location='+location+'&startDate='+startDate+'&endDate='+endDate+'&jobs='+jobs+'&startYear='+startYear+'&endYear='+endYear+'&startGpa='+startGpa+'&endGpa='+endGpa;
            url = url.replace(':company_id', company_id);
            url = url.replace(':job_id', job_id);

            table = $('#myTable').dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: url,
                language: languageOptions(),
                "fnDrawCallback": function (oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                order: [['1', 'ASC']],
                columns: [
                    { data: 'DT_Row_Index', sortable:false, searchable: false },
                    {data: 'name', name: 'name', width: '17%'},
                    {data: 'title', name: 'title', width: '17%'},
                    {data: 'location', name: 'location'},
                    {data: 'status', name: 'status'},
                    // {data: 'action', name: 'action', width: '15%', searchable : false}
                ]
            });
            new $.fn.dataTable.FixedHeader(table);
        }

        $('body').on('click', '.sa-params,.delete-document', function(){
            var id = $(this).data('row-id');
            const deleteDocClassPresent = $(this).hasClass('delete-document');
            const saParamsClassPresent = $(this).hasClass('sa-params');

            swal({
                title: "@lang('errors.areYouSure')",
                text: "@lang('errors.deleteWarning')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "@lang('app.delete')",
                cancelButtonText: "@lang('app.cancel')",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {
                    let url = '';

                    if (deleteDocClassPresent) {
                        url = "{{ route('admin.documents.destroy',':id') }}";
                    }
                    if (saParamsClassPresent) {
                        url = "{{ route('admin.job-applications.destroy',':id') }}";
                    }

                    url = url.replace(':id', id);
                    
                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {'_token': token, '_method': 'DELETE'},
                        success: function (response) {
                            if (response.status == "success") {
                                $.unblockUI();
                                if (deleteDocClassPresent) {
                                    docTable._fnDraw();
                                }
                                if (saParamsClassPresent) {
                                    table._fnDraw();
                                }
                            }
                        }
                    });
                }
            });
        });

        table.on('click', '.show-detail', function () {
            $(".right-sidebar").slideDown(50).addClass("shw-rside");

            var id = $(this).data('row-id');
            var company_id = $(this).data('company-id');
            var job_id = $(this).data('job-id');
            
            var url = "{{ route('admin.company.job-applications.show', [':company_id', ':job_id', ':application_id']) }}";
            url = url.replace(':application_id', id);
            url = url.replace(':company_id', company_id);
            url = url.replace(':job_id', job_id);

            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    if (response.status == "success") {
                        $('#right-sidebar-content').html(response.view);
                    }
                }
            });
        });

        $('.toggle-filter').click(function () {
            $('#ticket-filters').toggle('slide');
        });

        $('body').on('click', '.show-document', function() {
            const type = $(this).data('modal-name');
            const id = $(this).data('row-id');

            const url = "{{ route('admin.documents.index') }}?documentable_type="+type+"&documentable_id="+id;

            $.ajaxModal('#application-lg-modal', url);
        })

        $('body').on('click', '.show-exp', function() {
            const type = $(this).data('modal-name');
            const id = $(this).data('row-id');

            const url = "{{ route('admin.exp') }}?type="+type+"&id="+id;

            $.ajaxModal('#application-lg-modal', url);
        })

        function exportJobApplication(){
            var startDate;
            var endDate;
            var status = $('#status').val();
            var jobs = $('#jobs').val();
            var location = $('#location').val();

             startDate = $('#start-date').val();
             endDate = $('#end-date').val();

            if(startDate == '' || startDate == null){
                startDate = 0;
            }

            if(endDate == '' || endDate == null){
                endDate = 0;
            }

            var url = '{{ route('admin.job-applications.export', [':status',':location', ':startDate', ':endDate', ':jobs']) }}';
            url = url.replace(':status', status);
            url = url.replace(':location', location);
            url = url.replace(':startDate', startDate);
            url = url.replace(':endDate', endDate);
            url = url.replace(':jobs', jobs);

            window.location.href = url;
        }

        function changeStatus(stat, id) {
            var url = "{{ route('admin.job-applications.updateIndex') }}";
            var token = "{{ csrf_token() }}";
            var status = '{{ request()->segment(6) }}';
            var job = '{{ request()->segment(5) }}';

            $.easyAjax({
                type: 'POST',
                url: url,
                data: {'_token': token, 'table': true, 'boardColumnIds[]': stat.value, 'applicationIds[]': id},
                success: function (response) {
                    if (response.status == "success") {
                        tableLoad('filter');
                        $('#totalJA'+job+'_'+status).text(parseInt($('#totalJA'+job+'_'+status).text())-1);
                        $('#totalJA'+job+'_'+stat.value).text(parseInt($('#totalJA'+job+'_'+stat.value).text())+1);
                    }
                }
            });
        }

    </script>
@endpush