<div class="modal fade" id="modal-tambah-keuangan" aria-labelledby="register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-keuangan-label">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-keuangan">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date-tambah-keuangan" class="form-label">Tanggal:</label>
                        <input type="date" name="date" id="date-tambah-keuangan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nominal-tambah-keuangan" class="form-label">Nominal:</label>
                        <input type="number" name="nominal" id="nominal-tambah-keuangan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="type-tambah-keuangan" class="form-label">Tipe:</label>
                        <select name="type" id="type-tambah-keuangan" class="form-select">
                            <option value="0">Pemasukan</option>
                            <option value="1">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub-category-tambah-keuangan" class="form-label">Tujuan:</label>
                        <select name="sub_category" id="sub-category-tambah-keuangan" class="sub-category-select select2-upper" style="width:100%">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan-tambah-keuangan" class="form-label">Keterangan:</label>
                        <input type="text" name="keterangan" id="keterangan-tambah-keuangan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
