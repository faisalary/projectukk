@extends('partials.vertical_menu')

@section('page_style')
<link rel="stylesheet" href="{{ asset('app-assets/vendor/css/pages/app-calendar.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/fullcalendar/fullcalendar.css') }}" />
<style>
    #outer {
        width: 100%;
        text-align: center;
        color: black;
    }

    #lowongan {
        text-align: center;
    }

    svg>g[class^='raphael-group-'] g {
        fill: none !important;
    }

    .fc-direction-ltr .fc-daygrid-event.fc-event-end,
    .fc-direction-rtl .fc-daygrid-event.fc-event-start {
        background: #DCEEE3;
        padding: 7px;
    }

    .fc-event-title {
        color: #4EA971 !important;
    }

    .fc .fc-daygrid-day-frame {
        min-height: 110px !important;
    }
</style>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h4 class="fw-bold text-sm">Dashboard Mitra Perusahaan - Periode 2024</h4>
    </div>
    <div class="d-none d-sm-flex">
        <select class="select2 form-select" data-placeholder="Filter Status">
            <option value="0">2022</option>
            <option value="1" selected>2024</option>
            <option value="2">2025</option>
            <option value="3">2026</option>
        </select>
    </div>
</div>
<!-- Statistics -->
<div class="col-12 mb-4">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title mb-0">Statistik Lowongan Pekerjaan</h5>
                <small class="text-muted">Terupdate 1 minggu lalu</small>
            </div>
        </div>
        <div class="card-body">
            <div class="row gy-3">
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-label-primary me-3 p-2">
                            <i class="ti ti-files ti-sm" style="font-size: 30px !important;"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">100</h5>
                            <p class="mb-0" style="font-size:18px;">Total</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-label-warning me-3 p-2">
                            <i class="ti ti-clock ti-sm" style="font-size: 30px !important;"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">100</h5>
                            <p class="mb-0" style="font-size:18px;">Belum Approved</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-label-danger me-3 p-2">
                            <i class="ti ti-clipboard-x ti-sm" style="font-size: 30px !important;"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">100</h5>
                            <p class="mb-0" style="font-size:18px;">Ditolak</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-label-info me-3 p-2">
                            <i class="ti ti-clipboard-x ti-sm" style="font-size: 30px !important;"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">100</h5>
                            <p class="mb-0" style="font-size:18px;">Publish</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Statistics -->

<!-- Bar Chart -->
<div class="col-12 mb-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center pb-0">
            <div>
                <h5 class="card-title fw-bold mb-0">Statistik Proses Seleksi</h5>
                <p>100 Kandidat</p>
            </div>
        </div>
        <div class="card-body">
            <div id="lowongan"></div>
        </div>
    </div>

    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 pb-0">
                    <div class="row border-bottom mb-4">
                        <div class="col text-center mb-3">
                            <h5 class="modal-title" id="modalCenterTitle">Statistik Proses Seleksi - <span id="jobName"></span> </h5>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="timeline mb-0 ps-3 pe-3">
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event pt-1">
                                    <div class="timeline-header mb-1">
                                        <div>
                                            <div class="badge bg-label-primary me-1 p-2">
                                                <i class="ti ti-users ti-sm"></i>
                                            </div>
                                            <span style="margin-top: 10px;">Total Kandidat</span>
                                        </div>
                                        <h5 style="margin-top: 10px;">100 Mahasiswa</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-secondary"></span>
                                <div class="timeline-event pt-1">
                                    <div class="timeline-header mb-1">
                                        <div>
                                            <div class="badge bg-label-secondary me-1 p-2">
                                                <i class="ti ti-clipboard-list ti-sm"></i>
                                            </div>
                                            <span style="margin-top: 10px;">Hasil Screening Admin LKM</span>
                                        </div>
                                        <h5 style="margin-top: 10px;">100 Mahasiswa</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-warning"></span>
                                <div class="timeline-event pt-1">
                                    <div class="timeline-header mb-1">
                                        <div>
                                            <div class="badge bg-label-warning me-1 p-2">
                                                <i class="ti ti-files ti-sm"></i>
                                            </div>
                                            <span style="margin-top: 10px;">Seleksi Tahap 1 - Tes Tulis</span>
                                        </div>
                                        <h5 style="margin-top: 10px;">100 Mahasiswa</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-warning"></span>
                                <div class="timeline-event pt-1">
                                    <div class="timeline-header mb-1">
                                        <div>
                                            <div class="badge bg-label-warning me-1 p-2">
                                                <i class="ti ti-files ti-sm"></i>
                                            </div>
                                            <span style="margin-top: 10px;">Seleksi Tahap 2 - Wawancara HR</span>
                                        </div>
                                        <h5 style="margin-top: 10px;">100 Mahasiswa</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-warning"></span>
                                <div class="timeline-event pt-1">
                                    <div class="timeline-header mb-1">
                                        <div>
                                            <div class="badge bg-label-warning me-1 p-2">
                                                <i class="ti ti-files ti-sm"></i>
                                            </div>
                                            <span style="margin-top: 10px;">Seleksi Tahap 3 - Wawancara User</span>
                                        </div>
                                        <h5 style="margin-top: 10px;">100 Mahasiswa</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-info"></span>
                                <div class="timeline-event pt-1">
                                    <div class="timeline-header mb-1">
                                        <div>
                                            <div class="badge bg-label-info me-1 p-2">
                                                <i class="ti ti-speakerphone ti-sm"></i>
                                            </div>
                                            <span style="margin-top: 10px;">Penawaran</span>
                                        </div>
                                        <h5 style="margin-top: 10px;">100 Mahasiswa</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-danger"></span>
                                <div class="timeline-event pt-1">
                                    <div class="timeline-header mb-1">
                                        <div>
                                            <div class="badge bg-label-danger me-1 p-2">
                                                <i class="ti ti-user-x ti-sm"></i>
                                            </div>
                                            <span style="margin-top: 10px;">Ditolak</span>
                                        </div>
                                        <h5 style="margin-top: 10px;">100 Mahasiswa</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-0">
                                <span class="timeline-point timeline-point-success"></span>
                                <div class="timeline-event pt-1 pb-0">
                                    <div class="timeline-header mb-1">
                                        <div>
                                            <div class="badge bg-label-success me-1 p-2">
                                                <i class="ti ti-user-check ti-sm"></i>
                                            </div>
                                            <span style="margin-top: 10px;">Diterima</span>
                                        </div>
                                        <h5 style="margin-top: 10px;">100 Mahasiswa</h5>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Bar Chart -->

<div class="col-xl-12">

    <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
                    <i class="tf-icons ti ti-calendar ti-xs me-1"></i> View Calender
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
                    <i class="tf-icons ti ti-table ti-xs me-1"></i> View Table
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                <div class="app-calendar-wrapper">
                    <div class="row g-0">
                        <!-- Calendar Sidebar -->
                        <div class="col app-calendar-sidebar" id="app-calendar-sidebar" style="border-right: 0px;">
                            <div class="text-center border-bottom">
                                <h5>Jadwal Seleksi</h5>
                                <h5>Tahap 1 UI/UX Designer</h5>
                            </div>
                            <div style="overflow-y: scroll; min-height: 41rem; max-height: 41rem; direction:rtl;">
                                <div class="my-3 mx-2 text-start" style="background-color: rgba(223, 255, 236, .7) ;">
                                    <div class="py-2 px-3" style="border-left: 10px solid #4EA971;">
                                        <h5 class="mb-2">Alfian Mohammad Rizki</h5>
                                        <p>UI/UX DESIGNER</p>
                                    </div>
                                </div>
                                <div class="my-3 mx-2 text-start" style="background-color: rgba(223, 255, 236, .7) ;">
                                    <div class="py-2 px-3" style="border-left: 10px solid #4EA971;">
                                        <h5 class="mb-2">Alfian Mohammad Rizki</h5>
                                        <span>UI/UX DESIGNER</span>
                                    </div>
                                </div>
                                <div class="my-3 mx-2 text-start" style="background-color: rgba(223, 255, 236, .7) ;">
                                    <div class="py-2 px-3" style="border-left: 10px solid #4EA971;">
                                        <h5 class="mb-2">Alfian Mohammad Rizki</h5>
                                        <span>UI/UX DESIGNER</span>
                                    </div>
                                </div>
                                <div class="my-3 mx-2 text-start" style="background-color: rgba(223, 255, 236, .7) ;">
                                    <div class="py-2 px-3" style="border-left: 10px solid #4EA971;">
                                        <h5 class="mb-2">Alfian Mohammad Rizki</h5>
                                        <span>UI/UX DESIGNER</span>
                                    </div>
                                </div>
                                <div class="my-3 mx-2 text-start" style="background-color: rgba(223, 255, 236, .7) ;">
                                    <div class="py-2 px-3" style="border-left: 10px solid #4EA971;">
                                        <h5 class="mb-2">Alfian Mohammad Rizki</h5>
                                        <span>UI/UX DESIGNER</span>
                                    </div>
                                </div>
                                <div class="my-3 mx-2 text-start" style="background-color: rgba(223, 255, 236, .7) ;">
                                    <div class="py-2 px-3" style="border-left: 10px solid #4EA971;">
                                        <h5 class="mb-2">Alfian Mohammad Rizki</h5>
                                        <span>UI/UX DESIGNER</span>
                                    </div>
                                </div>
                                <div class="my-3 mx-2 text-start" style="background-color: rgba(223, 255, 236, .7) ;">
                                    <div class="py-2 px-3" style="border-left: 10px solid #4EA971;">
                                        <h5 class="mb-2">Alfian Mohammad Rizki</h5>
                                        <span>UI/UX DESIGNER</span>
                                    </div>
                                </div>
                                <div class="my-3 mx-2 text-start" style="background-color: rgba(223, 255, 236, .7) ;">
                                    <div class="py-2 px-3" style="border-left: 10px solid #4EA971;">
                                        <h5 class="mb-2">Alfian Mohammad Rizki</h5>
                                        <span>UI/UX DESIGNER</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Calendar Sidebar -->

                        <!-- Calendar & Modal -->
                        <div class="col app-calendar-content">
                            <div class="card shadow-none border">
                                <div class="card-body pb-0">
                                    <!-- FullCalendar -->
                                    <div id="calendar2"></div>
                                </div>
                            </div>
                            <div class="app-overlay"></div>
                        </div>
                        <!-- /Calendar & Modal -->
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="navs-pills-top-profile" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-status-mahasiswa">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width: 100px;">NAMA</th>
                                <th style="min-width: 100px;">POSISI</th>
                                <th style="min-width: 100px;">TANGGAL</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
<script src="{{asset('app-assets/js/app-calendar-events.js')}}"></script>
<script src="{{asset('app-assets/js/app-calendar.js')}}"></script>
<script src="{{asset('app-assets/vendor/libs/fullcalendar/fullcalendar.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
<script>
    FusionCharts.ready(function() {
        var lowongan = new FusionCharts({
            type: "scrollbar2d",
            renderAt: "lowongan",
            id: "grouped-bar-chart-with-scrolling",
            width: "100%",
            height: "300",
            dataFormat: "json",
            dataSource: {
                chart: {
                    theme: "fusion",
                    "scrollPosition": "right",
                    "palettecolors": "#4EA971"
                },
                categories: [{
                    category: [{
                            label: "Front-End Developer"
                        },
                        {
                            label: "Back-End Developer"
                        },
                        {
                            label: "Fullstack Developer"
                        },
                        {
                            label: "Mobile Developer"
                        },
                        {
                            label: "UIUX Designer"
                        },
                        {
                            label: "System Analyst"
                        },
                        {
                            label: "Technical Writer"
                        },
                        {
                            label: "Fullstack Developer"
                        },
                        {
                            label: "Mobile Developer"
                        },
                        {
                            label: "UIUX Designer"
                        },
                        {
                            label: "System Analyst"
                        },
                        {
                            label: "Technical Writer"
                        }
                    ]
                }],
                dataSet: [{
                    data: [{
                            value: "12"
                        },
                        {
                            value: "23"
                        },
                        {
                            value: "16"
                        },
                        {
                            value: "17"
                        },
                        {
                            value: "15"
                        },
                        {
                            value: "20"
                        },
                        {
                            value: "21"
                        },
                        {
                            value: "10"
                        },
                        {
                            value: "7"
                        },
                        {
                            value: "5"
                        },
                        {
                            value: "4"
                        },
                        {
                            value: "11"
                        }
                    ]
                }]
            }
        }).render();

        // Add event listener to the chart
        lowongan.addEventListener("dataplotClick", function(eventObj, dataObj) {
            // Display modal with the jobName
            showModal(dataObj.categoryLabel);
        });
    });

    function showModal(jobName) {
        var modaljobName = document.getElementById("jobName");
        modaljobName.innerHTML = jobName;

        var modal = new bootstrap.Modal(document.getElementById("modalCenter"));
        modal.show();
    }
</script>

<script>
    var jsonData = [{
            "nomor": "1",
            "nama": "Arvin  Bagaskara",
            "posisi": "UI/UX Designer",
            "tanggal": "Selasa, 30 Juli 2023",
            "status": "<span class='badge bg-label-secondary'>Belum Seleksi Tahap 1</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"
        },
        {
            "nomor": "2",
            "nama": "Kadavi Wijaya Saputra",
            "posisi": "UI/UX Designer",
            "tanggal": "Selasa, 30 Juli 2023",
            "status": "<span class='badge bg-label-secondary'>Belum Seleksi Tahap 1</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"
        },
        {
            "nomor": "3",
            "nama": "Kevin Nathaniel ",
            "posisi": "UI/UX Designer",
            "tanggal": "Selasa, 30 Juli 2023",
            "status": "<span class='badge bg-label-secondary'>Belum Seleksi Tahap 1</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"
        },
        {
            "nomor": "4",
            "nama": "Kevin Nathaniel ",
            "posisi": "UI/UX Designer",
            "tanggal": "Selasa, 30 Juli 2023",
            "status": "<span class='badge bg-label-secondary'>Belum Seleksi Tahap 1</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"
        }
    ];
    var table = $('#table-status-mahasiswa').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "posisi"
            },
            {
                data: "tanggal"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ],
    });
</script>

<script>
    const calendarEl = document.getElementById('calendar2')
    const calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        html: true,
        displayEventTime: false,
        dayMaxEvents: true,
        initialView: 'dayGridMonth',
        events: [{
                title: 'Tahap 1 Front-End',
                start: new Date()
            },
            {
                title: 'Tahap 1 UI/UX',
                start: new Date()
            },
            {
                title: 'Tahap 1 UI/UX',
                start: new Date()
            },
            {
                title: 'Tahap 2 Front-End',
                start: '2024-05-18'
            },
            {
                title: 'Tahap 2 UIUX',
                start: '2024-05-18'
            },
            {
                title: 'Tahap 3 Front-End',
                start: '2024-05-22'
            },
            {
                title: 'Tahap 3 UI/UX',
                start: '2024-05-22'
            },
        ]
    })

    calendar.render()
</script>
@endsection