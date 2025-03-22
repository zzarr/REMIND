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

    @include('operator.pasien.create-modal')
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

            $("form").submit(function(e) {
                e.preventDefault(); // Mencegah refresh halaman


                let formData = {
                    nama: $("input[name='nama']").val(),
                    usia: $("input[name='usia']").val(),
                    jenis_kelamin: $("select[name='jenis_kelamin']").val(),
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('operator.pasien.store') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        Notiflix.Loading.standard("Menyimpan...");
                    },
                    success: function(response) {
                        Notiflix.Loading.remove();

                        if (response.success) {
                            Notiflix.Notify.success(response.message);
                            $("form")[0].reset();
                            $("#tambahAkun-modal").modal("hide");
                            window.location.reload();

                        } else {
                            Notiflix.Notify.failure(response.message ||
                                "Gagal menyimpan data.");
                        }
                    },
                    error: function(xhr) {
                        Notiflix.Loading.remove();

                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            let errorMessages = Object.values(errors).map(err => err.join(" "))
                                .join("<br>");
                            Notiflix.Report.failure("Gagal!", errorMessages, "Tutup");
                        } else {
                            Notiflix.Notify.failure("Terjadi kesalahan. Coba lagi.");
                        }
                    }
                });
            });

            // Inisialisasi Simple-DataTables
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

            // **Fungsi untuk me-load ulang data tabel setelah perubahan**
            function loadUserData() {
                $.ajax({
                    url: "{{ route('operator.pasien.data') }}", // Sesuaikan dengan route API-mu
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

                        let newData = response.data.map(user => [
                            user.nama,
                            user.usia.toString(),
                            user.jenis_kelamin,
                            `
                <a href="/users/${user.id}/edit" class="btn btn-sm btn-outline-secondary" title="Edit">
                    <i class="ti ti-edit fs-5"></i>
                </a>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteUser(${user.id})" title="Hapus">
                    <i class="ti ti-trash fs-5"></i>
                </button>
                `
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

            // **Panggil fungsi load data saat halaman dimuat**
            loadUserData();

        });
    </script>
@endpush
