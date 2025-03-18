@extends('operator.layout.app')
@section('title', 'Dashboard ')
@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="row justifify-content-center">
                <div class="col-lg-4">
                    <div class="card  rounded-3">
                        <div class="card-header bg-healt">
                            <p class="text-white mb-0 fw-semibold">Pasien</p>
                        </div>
                        <div class="card-body shadow-custom">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">

                                    <h3 class="my-1 font-20 fw-bold ">24k</h3>

                                </div><!--end col-->
                                <div class="col-3 align-self-center">

                                    <i class="fas fa-bed font-24 align-self-center "></i>

                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card  rounded-3 shadow-custom">
                        <div class="card-header bg-healt">
                            <p class="text-white mb-0 fw-semibold">Tim Peneliti</p>
                        </div>
                        <div class="card-body ">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">

                                    <h3 class="my-1 font-20 fw-bold ">24k</h3>

                                </div><!--end col-->
                                <div class="col-3 align-self-center">

                                    <i class="ti ti-users font-24 align-self-center "></i>

                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card  rounded-3 shadow-custom">
                        <div class="card-header bg-healt">
                            <p class="text-white mb-0 fw-semibold">Kuisioner</p>
                        </div>
                        <div class="card-body ">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">

                                    <h3 class="my-1 font-20 fw-bold ">24k</h3>

                                </div><!--end col-->
                                <div class="col-3 align-self-center">

                                    <i class="ti ti-clipboard-list font-24 align-self-center "></i>

                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-healt text-white">
                            Riwayat Pretest
                        </div>
                        <div class="card-body shadow-custom">
                            <div class="table-responsive">
                                <table class="table mb-0 table-centered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Tanggal Pretest</th>
                                            <th>Hasil</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Ahmad
                                            </td>
                                            <td>14</td>
                                            <td>11-11-2024</td>
                                            <td>30 </td>
                                            <td class="text-end">
                                                <div class="dropdown d-inline-block">
                                                    <a class="dropdown-toggle arrow-none" id="dLabel11"
                                                        data-bs-toggle="dropdown" href="#" role="button"
                                                        aria-haspopup="false" aria-expanded="false">
                                                        <i class="las la-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dLabel11">
                                                        <a class="dropdown-item" href="#">Creat Project</a>
                                                        <a class="dropdown-item" href="#">Open Project</a>
                                                        <a class="dropdown-item" href="#">Tasks Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table><!--end /table-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="card">
                        <div class="card-header bg-healt text-white">
                            Riwayat Posttest
                        </div>
                        <div class="card-body shadow-custom">
                            <div class="table-responsive">
                                <table class="table mb-0 table-centered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Tanggal Posttest</th>
                                            <th>Hasil</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Ahmad
                                            </td>
                                            <td>14</td>
                                            <td>11-11-2024</td>
                                            <td>30 </td>
                                            <td class="text-end">
                                                <div class="dropdown d-inline-block">
                                                    <a class="dropdown-toggle arrow-none" id="dLabel11"
                                                        data-bs-toggle="dropdown" href="#" role="button"
                                                        aria-haspopup="false" aria-expanded="false">
                                                        <i class="las la-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dLabel11">
                                                        <a class="dropdown-item" href="#">Creat Project</a>
                                                        <a class="dropdown-item" href="#">Open Project</a>
                                                        <a class="dropdown-item" href="#">Tasks Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table><!--end /table-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-lg-9 -->
        <div class="col-lg-3"><!--Start col-lg-3-->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Statistik Tingkat Stres Pasien</h4>
                        </div><!--end col-->

                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body shadow-custom">
                    <div class="text-center">
                        <div id="ana_device" class="apex-charts"></div>
                        <h6 class="bg-light-alt py-3 px-2 mb-0">
                            <i data-feather="calendar" class="align-self-center icon-xs me-1"></i>
                            01 January 2020 to 31 December 2020
                        </h6>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table border-dashed mb-0">
                            <thead>
                                <tr>
                                    <th>Device</th>
                                    <th class="text-end">Sassions</th>
                                    <th class="text-end">Day</th>
                                    <th class="text-end">Week</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Dasktops</td>
                                    <td class="text-end">1843</td>
                                    <td class="text-end">-3</td>
                                    <td class="text-end">-12</td>
                                </tr>
                                <tr>
                                    <td>Tablets</td>
                                    <td class="text-end">2543</td>
                                    <td class="text-end">-5</td>
                                    <td class="text-end">-2</td>
                                </tr>
                                <tr>
                                    <td>Mobiles</td>
                                    <td class="text-end">3654</td>
                                    <td class="text-end">-5</td>
                                    <td class="text-end">-6</td>
                                </tr>

                            </tbody>
                        </table><!--end /table-->
                    </div><!--end /div-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-lg-3-->
    </div>

@endsection

@push('script')
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>



    <script>
        // ====== Donut Chart: Devices ======
        const optionsDevice = {
            chart: {
                height: 255,
                type: "donut"
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "85%"
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            series: [50, 25, 25],
            legend: {
                show: true,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                fontSize: "13px"
            },
            labels: ["Turun", "Naik", "Netral"],
            colors: ["#2a76f4", "rgba(42, 118, 244, .5)", "rgba(42, 118, 244, .18)"],
            responsive: [{
                breakpoint: 600,
                options: {
                    plotOptions: {
                        donut: {
                            customScale: 0.2
                        }
                    },
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: false
                    }
                }
            }],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " %";
                    }
                }
            }
        };
        const chartDevice = new ApexCharts(document.querySelector("#ana_device"), optionsDevice);

        // ====== Render all Charts on DOM Content Loaded ======
        window.addEventListener("DOMContentLoaded", () => {

            chartDevice.render();
            chartCircle.render();
        });
    </script>
@endpush
