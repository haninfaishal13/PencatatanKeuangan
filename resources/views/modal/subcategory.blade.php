<div class="modal fade" id="modal-subcategory" tabindex="-1" aria-labelledby="register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-keuangan-label">Subkategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <h5 id="name-category">...</h5>
                    <button class="btn btn-primary btn-sm ms-auto" id="btn-tambah-subcategory"><i class="fas fa-plus me-2"></i>Subkategori</button>
                </div>

                <table class="table table-stripped">
                    <thead>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody id="tb-subcategory">
                        <tr>
                            <td colspan="3">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tambah-subcategory" tabindex="-1" aria-labelledby="register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subcategory-label">Tambah Subkategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-subcategory">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name-tambah-subcategory" class="form-label">Nama:</label>
                        <input type="text" name="name" id="name-tambah-subcategory" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-subcategory" tabindex="-1" aria-labelledby="register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subcategory-label">Tambah Subkategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-subcategory">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name-edit-subcategory" class="form-label">Nama:</label>
                        <input type="text" name="name" id="name-tambah-subcategory" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
