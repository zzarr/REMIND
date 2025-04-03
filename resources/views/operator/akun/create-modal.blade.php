<div class="modal fade" id="tambahAkun-modal" tabindex="-1" aria-labelledby="exampleModalPrimary1" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="tambahAkun-from">
                <div class="modal-header bg-healt">
                    <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Tambah Akun</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                            placeholder="Masukkan nama" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="Masukkan password"
                                name="password">
                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                data-target="#password">
                                <i class="ti ti-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Konfirmasi password" name="confirmPassword">
                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                data-target="#confirmPassword">
                                <i class="ti ti-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama">Role</label>
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option value="operator">Operator</option>
                            <option value="tim peneliti">Tim Peneliti</option>
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
