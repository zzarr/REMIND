<!-- Modal Detail -->
<div class="modal fade" id="modalDetailPasien" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <p><strong>Nama:</strong> <span id="detail-nama"></span></p>
                        <p><strong>Skor Pretest:</strong> <span id="detail-pretest"></span></p>
                        <p><strong>Skor Posttest:</strong> <span id="detail-posttest"></span></p>
                        <p><strong>Kesimpulan:</strong> <span id="detail-kesimpulan"></span></p>

                    </div>
                    <div class="col-6">
                        <div class="chart-demo">
                            <div id="apex_line1" class="apex-charts"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
