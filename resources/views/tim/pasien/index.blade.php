@extends('operator.layout.app')
@section('title', 'Pasien')
@section('content')
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-custom">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button class="btn btn-outline-green" title="tambah" data-bs-toggle="modal"
                            data-bs-target="#tambahPasien-modal"><i class="ti ti-plus fs-5"></i></button>

                    </div>

                    <div class="table-responsive">
                        <table class="table" id="pasien-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Usia</th>
                                    <th>Jenis Kelamin</th>
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
    <script src="{{ asset('libs/simple-datatables/umd/simple-datatables.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            const dataTable = new simpleDatatables.DataTable("#pasien-table", {
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

            function loadPasienData() {
                $.ajax({
                    url: "{{ route('tim_peneliti.pasien.data') }}",
                    method: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        console.log("Memuat data...");
                    },
                    success: function(response) {
                        if (!response.data || response.data.length === 0) {
                            dataTable.clear();
                            dataTable.refresh();
                            return;
                        }

                        dataTable.clear();
                        let newData = response.data.map(pasien => {
                            let aksiBtn = "";

                            if (!pasien.hasil_analisis) {
                                // Belum isi pretest
                                aksiBtn = `
                        <a href="/tim-peneliti/kuisioner/pretest/${pasien.id}" class="btn btn-sm btn-outline-primary" title="Isi Pretest">
                            <i class="ti ti-clipboard-text fs-5"></i> Pretest
                        </a>
                    `;
                            } else if (pasien.hasil_analisis && pasien.hasil_analisis
                                .skor_posttest === null) {
                                // Sudah isi pretest, belum posttest
                                aksiBtn = `
                        <a href="/tim-peneliti/kuisioner/posttest/${pasien.id}" class="btn btn-sm btn-outline-success" title="Isi Posttest">
                            <i class="ti ti-checklist fs-5"></i> Posttest
                        </a>
                    `;
                            } else {
                                // Sudah isi semua, tidak tampilkan tombol
                                aksiBtn = `<span class="badge bg-success">Selesai</span>`;
                            }

                            return [
                                pasien.nama,
                                pasien.usia.toString(),
                                pasien.jenis_kelamin,
                                aksiBtn
                            ];
                        });

                        dataTable.rows().add(newData);
                        dataTable.refresh();
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data:", error);
                    }
                });
            }


            loadPasienData();

        });
    </script>
@endpush
