@extends('partials_admin.template')

@section('page_style')
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
</style>
@endsection

@section('main')

<!-- Statistics -->
<div class="col-12 mb-4">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title mb-0">Menunggu Approval</h5>
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
                            <p class="mb-0" style="font-size:18px;">Mitra</p>
                            <a href="/company/kelola-mitra" class="mb-0 text-primary" style="font-size:18px;">Detail<i class="ti ti-arrow-right mb-1 ms-1"></i></a>
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
                            <p class="mb-0" style="font-size:18px;">Lowongan</p>
                            <a href="/kelola/lowongan/lkm" class="mb-0 text-warning" style="font-size:18px;">Detail<i class="ti ti-arrow-right mb-1 ms-1"></i></a>
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
                            <p class="mb-0" style="font-size:18px;">SPM</p>
                            <a href="" class="mb-0 text-danger" style="font-size:18px;">Detail<i class="ti ti-arrow-right mb-1 ms-1"></i></a>
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
                            <p class="mb-0" style="font-size:18px;">Berkas</p>
                            <a href="" class="mb-0 text-info" style="font-size:18px;">Detail<i class="ti ti-arrow-right mb-1 ms-1"></i></a>
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
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title fw-bold mb-0">Lowongan Publish</h5>
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
                <div class="modal-body pt-0">
                    <div class="row">
                        <div class="col text-center">
                            <h4 class="modal-title" id="modalCenterTitle">Lowongan Publish</h4>
                            <h5 id="companyName"></h5>
                        </div>
                    </div>
                    <div class="row" style="overflow-y: auto; min-height: 150px; max-height: 170px;">
                        <div class="col-12 border-top">
                            <div class="row">
                                <div class="col-6">
                                    <ul class="pt-2 mb-0" style="color: #4EA971; font-size:25px;">
                                        <li>
                                            <h5>UI/UX Designer</h5>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 text-end">
                                    <ul class="list-unstyled pt-2 mb-0">
                                        <li>
                                            <h5 class="pt-2">4 Kuota penerimaan</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 border-top">
                            <div class="row">
                                <div class="col-6">
                                    <ul class="pt-2 mb-0" style="color: #4EA971; font-size:25px;">
                                        <li>
                                            <h5>FrontEnd Developer</h5>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 text-end">
                                    <ul class="list-unstyled pt-2 mb-0">
                                        <li>
                                            <h5 class="pt-2">4 Kuota penerimaan</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 border-top">
                            <div class="row">
                                <div class="col-6">
                                    <ul class="pt-2 mb-0" style="color: #4EA971; font-size:25px;">
                                        <li>
                                            <h5>Fullstack Developer</h5>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 text-end">
                                    <ul class="list-unstyled pt-2 mb-0">
                                        <li>
                                            <h5 class="pt-2">4 Kuota penerimaan</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 border-top">
                            <div class="row">
                                <div class="col-6">
                                    <ul class="pt-2 mb-0" style="color: #4EA971; font-size:25px;">
                                        <li>
                                            <h5>Mobile Developer</h5>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 text-end">
                                    <ul class="list-unstyled pt-2 mb-0">
                                        <li>
                                            <h5 class="pt-2">4 Kuota penerimaan</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Bar Chart -->

<div class="row">
    <!-- Donut Chart -->
    <div class="col-md-6 col-12 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-0">Proses Seleksi</h5>
                </div>
                <div class="d-none d-sm-flex">
                    <select class="select2 form-select" data-placeholder="Filter Status">
                        <option value="0">Techno Infinity</option>
                        <option value="1">Seven Inc</option>
                        <option value="2">Neuron Networks</option>
                        <option value="3">Tabel Data Indonesia</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div id="proses"></div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mb-3">
                        <div class="d-sm-flex d-block">
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1" style="background-color: #F94144"></span> Tahap 1
                            </div>
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1" style="background-color: #F3722C"></span> Tahap 2
                            </div>
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1" style="background-color: #F8961E"></span> Tahap 3
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <div class="d-sm-flex d-block">
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1" style="background-color: #F9C74F"></span> Penawaran
                            </div>
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1" style="background-color: #90BE6D"></span> Diterima
                            </div>
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1"  style="background-color: #2D9CDB"></span> Ditolak
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Donut Chart -->

    <!-- Pie Chart -->
    <div class="col-md-6 col-12 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-0">Rekapitulasi Mahasiswa Magang</h5>
                </div>

            </div>
            <div class="card-body">
                <div id="rekap"></div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mb-3">
                        <div class="d-sm-flex d-block">
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1" style="background-color: #FF9F43"></span> Magang Fakultas
                            </div>
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1" style="background-color: #7B61FF"></span> Magang Mandiri
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Pie Chart -->

</div>


@endsection

@section('page_script')
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

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
                            label: "Techno Infinity"
                        },
                        {
                            label: "Seven Inc"
                        },
                        {
                            label: "Neuron Networks"
                        },
                        {
                            label: "Tabel Data Indonesia"
                        },
                        {
                            label: "Inovasi Daya Solusi"
                        },
                        {
                            label: "Techno Infinity"
                        },
                        {
                            label: "Seven Inc"
                        },
                        {
                            label: "Neuron Networks"
                        },
                        {
                            label: "Tabel Data Indonesia"
                        },
                        {
                            label: "Inovasi Daya Solusi"
                        },
                        {
                            label: "Techno Infinity"
                        },
                        {
                            label: "Seven Inc"
                        },
                        {
                            label: "Neuron Networks"
                        },
                        {
                            label: "Tabel Data Indonesia"
                        },
                        {
                            label: "Inovasi Daya Solusi"
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
                            value: "21"
                        },
                        {
                            value: "25"
                        },
                        {
                            value: "23"
                        },
                        {
                            value: "12"
                        },
                        {
                            value: "10"
                        },
                        {
                            value: "7"
                        },
                        {
                            value: "9"
                        },
                        {
                            value: "6"
                        },
                        {
                            value: "15"
                        },
                        {
                            value: "28"
                        }
                    ]
                }]
            }
        }).render();

        // Add event listener to the chart
        lowongan.addEventListener("dataplotClick", function(eventObj, dataObj) {
            // Display modal with the companyName
            showModal(dataObj.categoryLabel);
        });
    });

    function showModal(companyName) {
        var modalCompanyName = document.getElementById("companyName");
        modalCompanyName.innerHTML = companyName;

        var modal = new bootstrap.Modal(document.getElementById("modalCenter"));
        modal.show();
    }
</script>

<script>
    FusionCharts.ready(function() {
        var kandidat = new FusionCharts({
            type: "doughnut2d",
            renderAt: "proses",
            width: "100%",
            height: "400",
            dataFormat: "json",
            dataSource: {
                chart: {
                    showvalues: "0",
                    showlabels: "0",
                    defaultcenterlabel: "Total Kandidat 180",
                    decimals: "1",
                    plottooltext: "$label: $value Kandidat",
                    centerlabel: "Kandidat: $value",
                    theme: "fusion",
                    showlegend: "0",
                    "palettecolors": "#F94144,#F3722C,#F8961E,#F9C74F,#90BE6D,#2D9CDB",
                    "enableMultiSlicing": "0"
                },
                data: [{
                        label: "Tahap 1",
                        value: "60"
                    },
                    {
                        label: "Tahap 2",
                        value: "50"
                    },
                    {
                        label: "Tahap 3",
                        value: "30"
                    },
                    {
                        label: "Penawaran",
                        value: "10"
                    },
                    {
                        label: "Diterima",
                        value: "10"
                    },
                    {
                        label: "Ditolak",
                        value: "10"
                    }
                ]

            }
        }).render();
    });
</script>

<script>
    FusionCharts.ready(function() {
        var rekap = new FusionCharts({
            type: "pie2d",
            renderAt: "rekap",
            width: "100%",
            height: "400",
            dataFormat: "json",
            dataSource: {
                chart: {
                    showvalues: "0",
                    showlabels: "0",
                    plottooltext: "$label : $value Mahasiswa",
                    legendposition: "bottom",
                    theme: "fusion",
                    showlegend: "0",
                    "palettecolors": "#FF9F43,#7B61FF",
                    "enableMultiSlicing": "0"
                },
                data: [{
                        label: "Magang Fakultas",
                        value: "60"
                    },
                    {
                        label: "Magang Mandiri",
                        value: "40"
                    }
                ]
            }
        }).render();
    });
</script>

@endsection