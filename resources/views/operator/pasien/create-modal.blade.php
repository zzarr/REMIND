<div class="modal fade" id="tambahPasien-modal" tabindex="-1" aria-labelledby="exampleModalPrimary1" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="tambahPasien-form">
                <div class="modal-header bg-healt">
                    <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Tambah Pasien</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" aria-describedby="emailHelp"
                            placeholder="Masukkan nama" name="nama">
                    </div>

                    <div class="mb-3">
                        <label for="usia">Usia</label>
                        <input type="number" class="form-control" id="usia" aria-describedby="emailHelp"
                            placeholder="Masukan Usia" name="usia">
                    </div>



                    <div class="mb-3">
                        <label for="jenis_kelamin">Jenis kelamin</label>
                        <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-de-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-de-primary btn-sm">Save</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
