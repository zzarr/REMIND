@extends('operator.layout.app')
@section('title', 'Akun')
@section('content')
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-custom">
                    <button class="btn btn-outline-primary" title="tambah" data-bs-toggle="modal"
                        data-bs-target="#tambahAkun-modal"><i class="ti ti-plus fs-5"></i></button>
                    <div class="table-responsive">
                        <table class="table" id="users-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
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

    @include('operator.akun.create-modal')

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('libs/table/datatable/datatables.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('libs/table/datatable/dt-global_style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('libs/simple-datatables/style.css') }}">

    <!-- DataTables CSS -->
@endpush

@push('script')
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/simple-datatables/umd/simple-datatables.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Simple-DataTables
            const dataTable = new simpleDatatables.DataTable("#users-table", {
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

            // Mengambil data dari server menggunakan AJAX
            function loadUserData() {
                $.ajax({
                    url: "{{ route('operator.akun.data') }}", // Ganti dengan route API-mu
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        // Kosongkan tabel sebelum mengisi ulang
                        dataTable.clear();

                        // Loop data dan masukkan ke dalam tabel
                        response.data.forEach(user => {
                            dataTable.rows().add([
                                user.name,
                                user.email,
                                user.role,
                                `
                <a href="/users/${user.id}/edit" class="btn btn-sm btn-outline-secondary" title="edit"><i class="ti ti-edit fs-5"></i></a>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteUser(${user.id})" title="Hapus"><i class="ti ti-trash fs-5" ></i></button>
                `
                            ]);
                        });

                        // Render ulang tabel
                        dataTable.refresh();
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data:", error);
                    }
                });
            }

            // Panggil fungsi load data saat halaman dimuat
            loadUserData();

            feather.replace();
        });
    </script>
@endpush
