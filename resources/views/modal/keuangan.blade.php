<div class="modal fade" id="modal-edit-keuangan" tabindex="-1" aria-labelledby="register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-keuangan-label">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-keuangan">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date-edit-keuangan" class="form-label">Tanggal:</label>
                        <input type="edit_date" name="date" id="date-edit-keuangan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nominal-edit-keuangan" class="form-label">Nominal:</label>
                        <input type="edit_number" name="nominal" id="nominal-edit-keuangan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="type-edit-keuangan" class="form-label">Tipe:</label>
                        <select name="edit_type" id="type-edit-keuangan" class="form-select">
                            <option value="0">Pemasukan</option>
                            <option value="1">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub-category-edit-keuangan" class="form-label">Tujuan:</label>
                        <select name="edit_sub_category" id="sub-category-edit-keuangan" class="form-select">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub-category-edit-keuangan" class="form-label">Keterangan:</label>
                        <input type="text" name="edit_keterangan" class="form-control" id="keterangan-edit-keuangan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
