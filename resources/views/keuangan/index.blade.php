@extends('_layout.main')
@section('title', 'Keuangan')
@section('content')
    <div class="mb-3">
        <div class="d-flex">
            <h3 id="user">Daftar Keuangan</h3>
            <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#modal-tambah-keuangan">Tambah Keuangan</button>
        </div>
    </div>

    <div class="my-2" id="filter-keuangan">
        <div class="card">
            <div class="card-body">
                <form id="filter-keuangan">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 mb-2">
                            Waktu:
                            <select name="filter-waktu" class="form-select" id="filter-waktu">
                                <option value="harian">Hari ini</option>
                                <option value="pekanan">Pekan ini</option>
                                <option value="bulanan">Bulan ini</option>
                                <option value="tahunan">Tahun ini</option>
                                <option value="semua" selected>Semua</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2" id="filter-jenis-select">
                            Jenis Pengeluaran:
                            <select name="filter-jenis" class="sub-category-select" id="filter-jenis" style="width:100%">
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            Tipe Pengeluaran:
                            <select name="filter-tipe" id="filter-tipe" class="form-select">
                                <option value="0">Pemasukan</option>
                                <option value="1">Pengeluaran</option>
                                <option value="2" selected>Semua</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="filter-submit"><i class="fas fa-filter me-2"></i>Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-stripped">
        <thead>
            <th>Tujuan</th>
            <th>Nominal</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </thead>
        <tbody id="tb-daftar-keuangan">
            <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        </tbody>
    </table>

    @include('modal.dashboard')
    @include('modal.keuangan')
@endsection
@section('after-script')
    <script src="{{asset('js/dashboard/keuangan.js')}}"></script>
    <script src="{{asset('js/keuangan/index.js')}}"></script>
@endsection
