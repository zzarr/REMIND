import jquery from 'libs/jquery';

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
                <a href="/users/${user.id}/edit" class="btn btn-sm btn-outline-primary" title="edit"><i class="ti ti-edit fs-5"></i></a>
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