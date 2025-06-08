@extends('tim.layout.app')
@section('title', 'Dashboard ')
@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card  rounded-3">
                        <div class="card-header bg-healt">
                            <p class="text-white mb-0 fw-semibold"></p>
                        </div>
                        <div class="card-body shadow-custom">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">
                                    <p class="text-dark mb-0 fw-semibold">Pretest</p>
                                    <h3 class="my-1 font-20 fw-bold ">{{ $pretest }} Pasien</h3>

                                </div><!--end col-->
                                <div class="col-3 align-self-center">

                                    <i class="fas fa-clipboard-list font-40 align-self-center "></i>

                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card  rounded-3 shadow-custom">
                        <div class="card-header bg-healt">

                        </div>
                        <div class="card-body ">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">
                                    <p class="text-dark mb-0 fw-semibold">Posttest</p>
                                    <h3 class="my-1 font-20 fw-bold ">{{ $posttest }} Pasien</h3>

                                </div><!--end col-->
                                <div class="col-3 align-self-center">

                                    <i class="fas fa-clipboard-list font-40 align-self-center "></i>

                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4"></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-healt text-white">
                            Riwayat Pretest
                        </div>
                        <div class="card-body shadow-custom">
                            <div class="mb-3">
                                <label for="select-sesi" class="form-label">Pilih Sesi Pertemuan</label>
                                <select id="select-sesi" class="form-select">
                                    <option value="all">Semua Sesi</option>
                                    @php
                                        $tanggalSesi = $riwayatPretest
                                            ->pluck('tanggal_pretest')
                                            ->map(function ($item) {
                                                return \Carbon\Carbon::parse($item)->format('Y-m-d');
                                            })
                                            ->unique()
                                            ->sort()
                                            ->values();

                                        $tanggalSesiPertama = $tanggalSesi->first(); // tanggal untuk sesi 1
                                    @endphp
                                    @foreach ($tanggalSesi as $index => $tanggal)
                                        <option value="{{ \Carbon\Carbon::parse($tanggal)->format('Y-m-d') }}"
                                            {{ $tanggal == $tanggalSesiPertama ? 'selected' : '' }}>
                                            Sesi {{ $index + 1 }}
                                            ({{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0 table-centered riwayat-pretest">
                                    <thead>

                                        <tr>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Tanggal Pretest</th>
                                            <th>Hasil</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayatPretest as $riwayat)
                                            <tr
                                                data-tanggal="{{ \Carbon\Carbon::parse($riwayat->tanggal_pretest)->format('Y-m-d') }}">
                                                <td>
                                                    {{ $riwayat->pasien->nama }}
                                                </td>
                                                <td>{{ $riwayat->pasien->usia }}</td>
                                                <td>{{ $riwayat->tanggal_pretest }}</td>
                                                <td>{{ $riwayat->skor_pretest }}</td>

                                            </tr>
                                        @endforeach
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
                            <div class="mb-3">
                                <label for="select-sesi-posttest" class="form-label">Pilih Sesi Pertemuan</label>
                                <select id="select-sesi-posttest" class="form-select">
                                    <option value="all">Semua Sesi</option>
                                    @php
                                        $tanggalSesiPost = $riwayatPosttest
                                            ->pluck('tanggal_posttest')
                                            ->map(function ($item) {
                                                return \Carbon\Carbon::parse($item)->format('Y-m-d');
                                            })
                                            ->unique()
                                            ->sort()
                                            ->values();
                                        $tanggalSesiPertamaPost = $tanggalSesiPost->first();
                                    @endphp
                                    @foreach ($tanggalSesiPost as $index => $tanggal)
                                        <option value="{{ \Carbon\Carbon::parse($tanggal)->format('Y-m-d') }}"
                                            {{ $tanggal == $tanggalSesiPertamaPost ? 'selected' : '' }}>
                                            Sesi {{ $index + 1 }}
                                            ({{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="table-responsive">
                                <table class="table mb-0 table-centered riwayat-posttest">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Tanggal Posttest</th>
                                            <th>Hasil</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayatPosttest as $riwayat)
                                            <tr
                                                data-tanggal="{{ \Carbon\Carbon::parse($riwayat->tanggal_posttest)->format('Y-m-d') }}">
                                                <td>
                                                    {{ $riwayat->pasien->nama }}
                                                </td>
                                                <td>{{ $riwayat->pasien->usia }}</td>
                                                <td>{{ $riwayat->tanggal_posttest }}</td>
                                                <td>{{ $riwayat->skor_posttest }}</td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table><!--end /table-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-lg-9 -->
        <div class="col-lg-3"><!--Start col-lg-3-->
            <div class="card" data-aos="fade-left" data-aos-duration="1200">
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

                    </div>

                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-lg-3-->
    </div>
@endsection
@push('script')
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>



    <script>
        const chartData = {
            series: [
                {{ $persenNaik }},
                {{ $persenTurun }},
                {{ $persenNetral }}
            ],
            labels: ["Naik", "Turun", "Netral"]
        };

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
            series: chartData.series,
            legend: {
                show: true,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                fontSize: "13px"
            },
            labels: chartData.labels,
            colors: [
                "#dc3545", // Solid
                "#ffc107", // Warna tengah, lebih tebal dari sebelumnya
                "#0d6efd" // Warna lembut tapi tetap kelihatan
            ],
            responsive: [{
                breakpoint: 600,
                options: {
                    plotOptions: {
                        donut: {
                            customScale: 0.2
                        }
                    },
                    chart: {
                        height: 200
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
        $(document).ready(function() {

            function filterTableByDate(selectId, tableBodySelector) {
                const selectedDate = $(selectId).val();
                $(tableBodySelector + ' tr').each(function() {
                    const rowDate = $(this).data('tanggal');
                    if (selectedDate === 'all' || rowDate === selectedDate) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            filterTableByDate('#select-sesi', '.riwayat-pretest tbody');
            $('#select-sesi').on('change', function() {
                filterTableByDate('#select-sesi', '.riwayat-pretest tbody');
            });

            filterTableByDate('#select-sesi-posttest', '.riwayat-posttest tbody');
            $('#select-sesi-posttest').on('change', function() {
                filterTableByDate('#select-sesi-posttest', '.riwayat-posttest tbody');
            });


        });
    </script>
@endpush
