@extends('operator.layout.app')
@section('title', 'Kuisioner')

@section('content')
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-custom">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button class="btn btn-outline-green shadow-custom" title="tambah" data-bs-toggle="modal"
                            data-bs-target="#tambahKuisioner-modal"><i class="ti ti-plus fs-5"></i></button>

                    </div>

                    <div class="table-responsive">
                        <table class="table" id="kuisioner-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Soal</th>
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

    @include('operator.kuisioner.create-modal')
    @include('operator.kuisioner.edit-modal')
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('libs/table/datatable/datatables.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('libs/table/datatable/dt-global_style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('libs/simple-datatables/style.css') }}">
    <style>
        #kuisioner-table th:first-child,
        #kuisioner-table td:first-child,
        #kuisioner-table th:last-child,
        #kuisioner-table td:last-child {
            width: 100px;
            /* Ubah sesuai kebutuhan */
            text-align: center;
        }
    </style>

    <!-- DataTables CSS -->
@endpush

@push('script')
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/simple-datatables/umd/simple-datatables.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>



    <script>
        $(document).ready(function() {

            $("#tambahKuisioner-form").submit(function(e) {
                e.preventDefault(); // Mencegah refresh halaman


                let formData = {
                    pertanyaan: $("textarea[name='pertanyaan']").val(),
                    is_positive: $("select[name='is_positive']").val(),
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('operator.kuisioner.store') }}",
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
                            $("#tambahKuisioner-modal").modal("hide");
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
            const dataTable = new simpleDatatables.DataTable("#kuisioner-table", {
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
            function loadData() {
                $.ajax({
                    url: "{{ route('operator.kuisioner.data') }}", // Sesuaikan dengan route API-mu
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

                        let newData = response.data.map((kuisioner, index) => [
                            (index + 1).toString(), // No (increment otomatis)
                            kuisioner.pertanyaan, // Soal
                            `
                <a href="#" class="btn btn-sm btn-outline-secondary edit-btn" data-id="${kuisioner.id}" title="Edit">
                                    <i class="ti ti-edit fs-5"></i>
                                </a>
                <a href="#" class="btn btn-sm btn-outline-danger btn-delete-kuisioner text-danger" data-id="${kuisioner.id}" title="Hapus">
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
            loadData();

            $(document).on('click', '.edit-btn', function() {
                let kuisionerId = $(this).data('id');

                $.ajax({
                    url: `/operator/kuisioner/edit/${kuisionerId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        $('#edit-pertanyaan').val(data.pertanyaan);
                        $('select[name="edit-is_positive"]').val(data.is_positive ?
                            'true' : 'false');
                        // Set ID ke modal agar bisa digunakan saat submit
                        $('#editKuisioner-modal').data('id', kuisionerId);

                        // Debugging: Pastikan modal dipanggil
                        console.log("Modal akan dibuka");

                        // Buka modal
                        $('#editKuisioner-modal').modal('show');

                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengambil data.');
                    }
                });
            });

            $(document).on('submit', '#editKuisioner-form', function(e) {
                e.preventDefault(); // Mencegah form dari reload halaman

                let kuisionerId = $('#editKuisioner-modal').data('id'); // Ambil ID dari modal
                let formData = {
                    pertanyaan: $('#edit-pertanyaan').val(), // Ambil nilai dari textarea
                    is_positive: $('select[name="edit-is_positive"]').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: `/operator/kuisioner/update/${kuisionerId}`, // Endpoint Laravel
                    type: 'PUT',
                    data: formData,
                    dataType: 'json',
                    beforeSend: function() {
                        Notiflix.Loading.standard("Memperbarui...");
                    },
                    success: function(response) {
                        Notiflix.Loading.remove();

                        if (response.success) {
                            Notiflix.Notify.success("Data berhasil diperbarui!");
                            $('#editKuisioner-modal').modal('hide'); // Tutup modal
                            location.reload(); // Reload halaman untuk update data
                        } else {
                            Notiflix.Notify.failure("Gagal memperbarui data.");
                        }
                    },
                    error: function(xhr) {
                        Notiflix.Loading.remove();
                        Notiflix.Notify.failure("Terjadi kesalahan saat mengupdate data.");
                        console.log(xhr.responseText); // Debugging error
                    }
                });
            });


            $(document).on("click", ".btn-delete-kuisioner", function() {
                let kuisionerId = $(this).data("id");
                deleteUser(kuisionerId);

            });


            function deleteUser(kuisionerId) {
                Notiflix.Confirm.show(
                    "Konfirmasi",
                    "Apakah Anda yakin ingin menghapus pengguna ini?",
                    "Ya, Hapus",
                    "Batal",
                    function okCallback() {
                        $.ajax({
                            url: `/operator/kuisioner/delete/${kuisionerId}`, // Endpoint hapus
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
