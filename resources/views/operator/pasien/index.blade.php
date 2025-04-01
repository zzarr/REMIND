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
    @include('operator.pasien.edit-modal')
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

            function loadUserData() {
                $.ajax({
                    url: "{{ route('operator.pasien.data') }}",
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
                        let newData = response.data.map(pasien => [
                            pasien.nama,
                            pasien.usia.toString(),
                            pasien.jenis_kelamin,
                            `
                        <a href="#" class="btn btn-sm btn-outline-secondary edit-btn" data-id="${pasien.id}" title="Edit">
                            <i class="ti ti-edit fs-5"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteUser(${pasien.id})" title="Hapus">
                            <i class="ti ti-trash fs-5"></i>
                        </button>
                    `
                        ]);
                        dataTable.rows().add(newData);
                        dataTable.refresh();
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data:", error);
                    }
                });
            }

            loadUserData();

            $("form").submit(function(e) {
                e.preventDefault();

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
                        console.log("Menyimpan data...");
                    },
                    success: function(response) {
                        if (!response.success) {
                            alert(response.message || "Gagal menyimpan data.");
                            return;
                        }
                        alert("Data berhasil disimpan!");
                        $("form")[0].reset();
                        $("#tambahPasien-modal").modal("hide");
                        loadUserData();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            let errorMessages = Object.values(errors).map(err => err.join(" "))
                                .join("\n");
                            alert("Gagal!\n" + errorMessages);
                        } else {
                            alert("Terjadi kesalahan. Coba lagi.");
                        }
                    }
                });
            });

            $(document).on("click", ".edit-btn", function() {
                var userId = $(this).data("id");
                $.ajax({
                    url: `/operator/pasien/edit/${userId}`,
                    type: "GET",
                    success: function(data) {
                        $("#edit-id").val(data.id);
                        $("#edit-nama").val(data.nama);
                        $("#edit-usia").val(data.usia);
                        $("#edit-jenis_kelamin").val(data.jenis_kelamin);
                        $("#editPasien-modal").modal("show");
                    },
                    error: function() {
                        alert("Gagal mengambil data pasien!");
                    }
                });
            });

            $(document).on("submit", "#editPasienForm", function(e) {
                e.preventDefault(); // Mencegah refresh halaman

                let formData = new FormData();
                formData.append("nama", $("#edit-nama").val());
                formData.append("usia", $("#edit-usia").val());
                formData.append("jenis_kelamin", $("#edit-jenis_kelamin").val());
                formData.append("_method", "PUT"); // Laravel akan mengenali ini sebagai PUT

                $.ajax({
                    url: `/operator/pasien/update/${$("#edit-id").val()}`,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    beforeSend: function() {
                        Notiflix.Loading.standard("Menyimpan...");
                    },
                    success: function(response) {
                        Notiflix.Loading.remove();

                        if (!response.success) {
                            Notiflix.Notify.failure(response.message ||
                                "Gagal memperbarui data.");
                            return;
                        }
                        Notiflix.Notify.success("Data berhasil diperbarui!");
                        $("#editPasienForm")[0].reset();
                        $("#editPasien-modal").modal("hide");
                        $("#dataTable").DataTable().ajax
                            .reload(); // Reload tabel dengan data terbaru
                    },
                    error: function(xhr) {
                        Notiflix.Loading.remove();

                        let errors = xhr.responseJSON?.errors;
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
        });
    </script>
@endpush
