@extends('operator.layout.app')
@section('title', 'Dashboard ')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row justifify-content-center">
                <div class="col-lg-4">
                    <div class="card  rounded-3">
                        <div class="card-header bg-healt">

                        </div>
                        <div class="card-body shadow-custom">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">

                                    <h3 class="my-1 font-20 fw-bold ">{{ $pasien }}</h3>
                                    <h6 class="text-uppercase text-muted mt-2 m-0 font-11">Pasien</h6>

                                </div><!--end col-->
                                <div class="col-3 align-self-center">

                                    <i class="fas fa-bed font-40 align-self-center "></i>

                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card  rounded-3 shadow-custom">
                        <div class="card-header bg-healt">
                            <p class="text-white mb-0 fw-semibold"></p>
                        </div>
                        <div class="card-body ">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">

                                    <h3 class="my-1 font-20 fw-bold ">{{ $user }}</h3>
                                    <h6 class="text-uppercase text-muted mt-2 m-0 font-11">Tim Peneliti</h6>

                                </div><!--end col-->
                                <div class="col-3 align-self-center">

                                    <i class="ti ti-users font-40 align-self-center "></i>

                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card  rounded-3 shadow-custom">
                        <div class="card-header bg-healt">

                        </div>
                        <div class="card-body ">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">

                                    <h3 class="my-1 font-20 fw-bold ">{{ $kuisioner }}</h3>
                                    <h6 class="text-uppercase text-muted mt-2 m-0 font-11">Kuisioner</h6>


                                </div><!--end col-->
                                <div class="col-3 align-self-center">

                                    <i class="ti ti-clipboard-list font-40 align-self-center "></i>

                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
        </div> <!-- end col-lg-9 -->
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
