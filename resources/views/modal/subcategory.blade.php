<div class="modal fade" id="modal-subcategory" tabindex="-1" aria-labelledby="register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-keuangan-label">Subkategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-keuangan">
                <div class="modal-body">
                    Kategori: <span id="name-category"></span>
                    <table class="table table-stripped">
                        <thead>
                            <th style="width:3%">No</th>
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
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-primary">Tambah</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>
