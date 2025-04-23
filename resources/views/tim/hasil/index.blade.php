@extends('tim.layout.app')

@section('title', 'hasil')

@section('content')
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-custom">


                    <div class="table-responsive">
                        <table class="table" id="hasil-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>skor Pretest</th>
                                    <th>skor Posttest</th>
                                    <th>Keterangan</th>
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

            function loadHasilData() {
                $.ajax({
                    url: "{{ route('tim_peneliti.hasil.data') }}", // Sesuaikan dengan route API-mu
                    method: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        Notiflix.Loading.standard("Memuat data...");
                        console.log("Memulai request baru...");
                    },
                    success: function(response) {
                        Notiflix.Loading.remove();
                        console.log("Data dari server:", response); // Debugging

                        if (!response.data || response.data.length === 0) {
                            console.warn("Data kosong atau tidak ditemukan!");
                            dataTable.clear();
                            dataTable.refresh();
                            return;
                        }

                        // **Hapus semua data lama sebelum menambahkan yang baru**
                        dataTable.clear();

                        let newData = response.data.map(hasil => [
                            hasil.pasien.nama,
                            hasil.skor_pretest?.toString() || "",
                            hasil.skor_posttest != null ? hasil.skor_posttest.toString() : "",
                            hasil.kesimpulan || ""
                        ]);

                        console.log("Data yang akan dimasukkan:", newData); // Debugging

                        // **Tambahkan data baru ke dalam tabel**
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


        });
    </script>
@endpush
