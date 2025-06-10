@extends('operator.layout.app')
@section('title', 'Akun')
@section('content')
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-custom">
                    <div class="btn-group" role="group" aria-label="Basic example">

                        <button class="btn btn-outline-green" title="tambah" data-bs-toggle="modal"
                            data-bs-target="#tambahAkun-modal"><i class="ti ti-plus fs-5"></i></button>

                    </div>

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
    @include('operator.akun.edit-modal')

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


            $("#tambahAkun-form").submit(function(e) {
                e.preventDefault(); // Mencegah refresh halaman

                let password = $("input[name='password']").val();
                let confirmPassword = $("input[name='confirmPassword']").val();

                // Cek apakah password dan konfirmasi password sama
                if (password !== confirmPassword) {
                    Notiflix.Notify.failure("Konfirmasi password tidak cocok!");
                    return; // Hentikan proses jika tidak cocok
                }

                let formData = {
                    name: $("input[name='name']").val(),
                    email: $("input[name='email']").val(),
                    password: password,
                    role: $("select[name='role']").val(),
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('operator.akun.store') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        Notiflix.Loading.standard("Menyimpan...");
                    },
                    success: function(response) {
                        Notiflix.Loading.remove();

                        if (response.success) {

                            $("form")[0].reset();
                            $("#tambahAkun-modal").modal("hide");
                            window.location.reload();
                            Notiflix.Notify.success(response.message);

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


            $(".toggle-password").click(function() {
                let target = $($(this).attr("data-target"));
                let icon = $(this).find("i");

                if (target.attr("type") === "password") {
                    target.attr("type", "text");
                    icon.removeClass("ti-eye").addClass("ti-eye-off");
                } else {
                    target.attr("type", "password");
                    icon.removeClass("ti-eye-off").addClass("ti-eye");
                }
            });


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

            // **Fungsi untuk me-load ulang data tabel setelah perubahan**
            function loadUserData() {
                $.ajax({
                    url: "{{ route('operator.akun.data') }}", // Sesuaikan dengan route API-mu
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
                            user.name,
                            user.email,
                            user.role,
                            `
                                <a href="#" class="btn btn-sm btn-outline-secondary edit-btn" data-id="${user.id}" title="Edit">
                                    <i class="ti ti-edit fs-5"></i>
                                </a>

                               <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger btn-delete-user text-danger" data-id="${user.id}" title="Hapus">
    <i class="ti ti-trash fs-5"></i>
</a>

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

            feather.replace();

            $(document).on("click", ".edit-btn", function() {
                var userId = $(this).data("id"); // Ambil ID dari tombol

                $.ajax({
                    url: "/operator/akun/edit/" + userId, // Route untuk mengambil data
                    type: "GET",
                    success: function(data) {
                        $("#edit-id").val(data.id);
                        $("#edit-name").val(data.name);
                        $("#edit-email").val(data.email);
                        $('#edit-password, #edit-confirmPassword').val(
                            ''); // Mengosongkan input password dan konfirmasi
                        $("#edit-role").val(data.role);
                        $("#editAkun-modal").modal("show"); // Tampilkan modal
                    },
                    error: function() {
                        alert("Gagal mengambil data akun!");
                    }
                });
            });

            $(document).on("submit", "#editAkunForm", function(e) {
                e.preventDefault(); // Mencegah refresh halaman

                let password = $("#edit-password").val();
                let confirmPassword = $("#edit-confirmPassword").val();


                // Cek apakah password dan konfirmasi password diisi
                if (password || confirmPassword) {
                    if (password !== confirmPassword) {
                        Notiflix.Notify.failure("Konfirmasi password tidak cocok!");
                        return; // Hentikan proses jika tidak cocok
                    }
                }

                let formData = {
                    id: $("#edit-id").val(),
                    name: $("#edit-name").val(),
                    email: $("#edit-email").val(),
                    role: $("#edit-role").val(),
                    password: confirmPassword,
                    _token: $('meta[name="csrf-token"]').attr("content") // Ambil CSRF token dari meta
                };

                // Jika password diisi, tambahkan ke formData
                if (password) {
                    formData.password = password;
                }

                $.ajax({
                    url: "/operator/akun/update/" + formData.id,
                    type: "PUT",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        Notiflix.Loading.standard("Menyimpan...");
                    },
                    success: function(response) {
                        Notiflix.Loading.remove();

                        if (response.success) {
                            Notiflix.Notify.success(response.message);
                            $("#editAkunForm")[0].reset(); // Reset form
                            $("#editAkun-modal").modal("hide"); // Tutup modal
                            window.location.reload();
                            // Reload tabel tanpa refresh halaman
                            $("#dataTable").DataTable().ajax.reload(null, false);
                        } else {
                            Notiflix.Notify.failure(response.message ||
                                "Gagal menyimpan data.");
                        }
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


            $(document).on("click", ".btn-delete-user", function() {
                let userId = $(this).data("id");
                deleteUser(userId);

            });


            function deleteUser(userId) {
                Notiflix.Confirm.show(
                    "Konfirmasi",
                    "Apakah Anda yakin ingin menghapus pengguna ini?",
                    "Ya, Hapus",
                    "Batal",
                    function okCallback() {
                        $.ajax({
                            url: `/operator/akun/delete/${userId}`, // Endpoint hapus
                            type: "DELETE",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr("content")
                            }, // Token CSRF
                            beforeSend: function() {
                                Notiflix.Loading.standard("Menghapus...");
                            },
                            success: function(response) {
                                Notiflix.Loading.remove();
                                if (response.success) {
                                    Notiflix.Notify.success(response.message);
                                    $("#dataTable").DataTable().ajax.reload(); // Refresh tabel
                                    window.location.reload();
                                } else {
                                    Notiflix.Notify.failure(response.message ||
                                        "Gagal menghapus data.");
                                }
                            },
                            error: function() {
                                Notiflix.Loading.remove();
                                Notiflix.Notify.failure("Terjadi kesalahan. Coba lagi.");
                            },
                        });
                    }
                );
            }
        });
    </script>
@endpush
