<div class="modal fade" id="editAkun-modal" tabindex="-1" aria-labelledby="exampleModalPrimary1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editAkunForm">
                <div class="modal-header bg-healt">
                    <h6 class="modal-title m-0 text-white">Edit Akun</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label for="edit-name">Nama</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="edit-email">Email address</label>
                        <input type="email" class="form-control" id="edit-email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="edit-password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="edit-password"
                                placeholder="Masukkan password" name="password">
                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                data-target="#edit-password">
                                <i class="ti ti-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-confirmPassword">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="edit-confirmPassword"
                                placeholder="Konfirmasi password" name="confirmPassword">
                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                data-target="#edit-confirmPassword">
                                <i class="ti ti-eye"></i>
                            </button>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="edit-role">Role</label>
                        <select class="form-select" id="edit-role" name="role">
                            <option value="operator">Operator</option>
                            <option value="tim peneliti">Tim Peneliti</option>
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
