@extends('tim.layout.app')

@section('title', 'Hasil')

@section('content')
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-custom">
                    <button id="exportExcel" class="btn btn-outline-success mb-3">
                        <i class="ti ti-file-export"></i> Export Excel
                    </button>



                    <div class="table-responsive">
                        <table class="table" id="hasil-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Skor Pretest</th>
                                    <th>Tingkat Stres</th>
                                    <th>Skor Posttest</th>
                                    <th>Tingkat Stres</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('tim.hasil.detailHasil-modal')

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('libs/table/datatable/datatables.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('libs/table/datatable/dt-global_style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('libs/simple-datatables/style.css') }}">
    <!-- notiflix -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.6.min.css" />

    <!-- DataTables CSS -->
@endpush

@push('script')
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <!-- DataTables JS -->
    <!--<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
    <script src="{{ asset('libs/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            // Inisialisasi Simple-DataTables
            const dataTable = new simpleDatatables.DataTable("#hasil-table", {
                searchable: true,
                fixedHeight: false,
                perPage: 5,
                perPageSelect: [5, 10, 20, 50],
                labels: {
                    placeholder: "Cari...",
                    perPage: "{select} data per halaman",
                    noRows: "Tidak ada data yang ditemukan",
                    info: "Menampilkan {start} hingga {end} dari {rows} data",
                    next: "<i class='fas fa-chevron-right'></i>",
                    prev: "<i class='fas fa-chevron-left'></i>"
                }
            });

            // 1. Variabel global
            let hasilAnalisisData = [];

            function loadHasilData() {
                $.ajax({
                    url: "{{ route('tim_peneliti.hasil.data') }}",
                    method: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        Notiflix.Loading.standard("Memuat data...");
                        console.log("Memulai request baru...");
                    },
                    success: function(response) {
                        Notiflix.Loading.remove();
                        console.log("Data dari server:", response);

                        if (!response.data || response.data.length === 0) {
                            console.warn("Data kosong atau tidak ditemukan!");
                            dataTable.clear();
                            dataTable.refresh();
                            return;
                        }

                        // 2. Simpan ke variabel global
                        hasilAnalisisData = response.data;

                        // Bersihkan tabel lama
                        dataTable.clear();

                        let newData = hasilAnalisisData.map(hasil => [
                            hasil.pasien.nama,
                            hasil.skor_pretest?.toString() || "-",
                            hasil.hasil_pretest || "-",
                            hasil.skor_posttest != null ? hasil.skor_posttest.toString() : "-",
                            hasil.hasil_posttest || "-",
                            hasil.kesimpulan || "-",
                            `<a href="#" class="btn btn-sm btn-outline-info detail-btn" data-id="${hasil.pasien.id}" title="detail hasil">
                    <i class="ti ti-eye fs-5"></i>
                </a>`
                        ]);

                        console.log("Data yang akan dimasukkan:", newData);

                        dataTable.rows().add(newData);
                        dataTable.refresh();

                        console.log("Tabel berhasil diperbarui!");
                    },
                    error: function(xhr, status, error) {
                        Notiflix.Loading.remove();
                        console.error("Gagal mengambil data:", error);
                    }
                });
            }

            loadHasilData();

            // Delegasi event agar tetap jalan walau tombol dibuat ulang
            $(document).on('click', '.detail-btn', function(e) {
                e.preventDefault();

                let id = $(this).data('id'); // Ambil ID pasien

                // Cari data yang sesuai di variabel global
                let hasil = hasilAnalisisData.find(item => item.pasien.id == id);

                console.log("Data yang ditemukan:", hasil);

                if (hasil) {
                    // Isi data ke modal
                    $('#detail-nama').text(hasil.pasien.nama);
                    $('#detail-pretest').text(hasil.skor_pretest ?? '-');
                    $('#detail-posttest').text(hasil.skor_posttest ?? '-');
                    $('#detail-kesimpulan').text(hasil.kesimpulan ?? '-');

                    const optionsLine1 = {
                        series: [{
                            data: [0, hasil.skor_pretest, hasil.skor_posttest ??
                                '0'
                            ] // titik awal, pretest, posttest
                        }],
                        chart: {
                            height: 350,
                            type: "line",
                            zoom: {
                                enabled: false
                            }
                        },
                        colors: ["#008ffb"],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: "straight",
                            width: [3]
                        },
                        title: {
                            text: "Hasil Pretest dan Posttest",
                            align: "left"
                        },
                        grid: {
                            row: {
                                colors: ["#f3f3f3", "transparent"],
                                opacity: 0.5
                            }
                        },
                        xaxis: {
                            categories: [" - ", "Pretest", "Posttest"]
                        },
                        yaxis: {
                            min: 0,
                            max: 40,
                            tickAmount: 4,
                            labels: {
                                formatter: function(value) {
                                    return value.toFixed(0); // tampilkan sebagai angka bulat
                                }
                            }
                        }
                    };

                    // Hapus chart sebelumnya jika sudah ada
                    if (window.chartLine1) {
                        window.chartLine1.destroy();
                    }


                    // Render chart untuk #apex_line1
                    const chartLine1 = new ApexCharts(document.querySelector("#apex_line1"), optionsLine1);
                    chartLine1.render();

                    // Tampilkan modal
                    $('#modalDetailPasien').modal('show');
                } else {
                    console.warn("Data tidak ditemukan untuk ID:", id);
                }
            });

            document.getElementById('exportExcel').addEventListener('click', function() {
                // Ambil data dari hasilAnalisisData
                const dataToExport = hasilAnalisisData.map(hasil => ({
                    'Nama': hasil.pasien.nama,
                    'Skor Pretest': hasil.skor_pretest ?? '-',
                    'Level Stres Pretest': hasil.hasil_pretest ?? '-',
                    'Skor Posttest': hasil.skor_posttest ?? '-',
                    'Level Stres Posttest': hasil.hasil_posttest ?? '-',
                    'Kesimpulan': hasil.kesimpulan ?? '-'
                }));

                // Buat worksheet dan workbook
                const worksheet = XLSX.utils.json_to_sheet(dataToExport);
                const workbook = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(workbook, worksheet, "Hasil Analisis");

                // Export file
                XLSX.writeFile(workbook, "hasil_analisis_pasien.xlsx");
            });

            // Konfigurasi chart Pretest dan Posttest dengan titik awal 0



        });
    </script>
@endpush
