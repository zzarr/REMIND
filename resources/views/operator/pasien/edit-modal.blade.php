<div class="modal fade" id="editPasien-modal" tabindex="-1" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editPasienForm">
                <div class="modal-header bg-healt">
                    <h6 class="modal-title m-0 text-white">Edit Akun</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label for="edit-nama">Nama</label>
                        <input type="text" class="form-control" id="edit-nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-usia">Usia</label>
                        <input type="text" class="form-control" id="edit-usia" name="usia" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-jenis_kelamin">Jenis kelamin</label>
                        <select class="form-select" aria-label="Default select example" name="jenis_kelamin"
                            id="edit-jenis_kelamin">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-de-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-de-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
