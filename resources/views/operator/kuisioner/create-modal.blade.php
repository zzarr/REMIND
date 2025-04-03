<div class="modal fade" id="tambahKuisioner-modal" tabindex="-1" aria-labelledby="exampleModalPrimary1" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="tambahKuisioner-modal">
                <div class="modal-header bg-healt">
                    <h6 class="modal-title m-0 text-white" id="exampleModalPrimary1">Tambah Kuisioner</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pertanyaan">pertanyaan</label>
                        <textarea type="text" rows="5" class="form-control" id="pertanyaan" aria-describedby="emailHelp"
                            placeholder="Masukkan pertanyaan" name="pertanyaan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nama">Jenis Soal</label>
                        <select class="form-select" aria-label="Default select example" name="is_positive">
                            <option value="false">Normal</option>
                            <option value="true">Positive</option>
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
