@extends('_layout.main')
@section('title', 'Dashboard')
@section('content')
    <div class="mb-3">
        <div class="d-flex">
            <h3 id="user">...</h3>
            <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#modal-tambah-keuangan"><i class="fas fa-plus me-2"></i>Tambah</button>
        </div>
        Total Saldo: <h5 id="total-saldo">...</h5>
    </div>
    <div class="row mb-5">
        <div class="col-md-3 col-6 mb-2">
            <div class="card">
                <div class="card-body">
                    <p>Masuk hari ini</p>
                    <h3 id="pemasukan-harian">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card">
                <div class="card-body">
                    <p>Keluar hari ini</p>
                    <h3 id="pengeluaran-harian">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card">
                <div class="card-body">
                    <p>Masuk Total</p>
                    <h3 class="text-success" id="pemasukan-total">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card">
                <div class="card-body">
                    <p>Keluar Total</p>
                    <h3 class="text-danger" id="pengeluaran-total">0</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <p class="fw-bold">Rekap Pengeluaran</p>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-5 col-sm-6 mb-2">
                        Bulan:
                        <select id="select-bulan" class="form-select" style="width:100%">
                            <option value="1" {{date('m') == 1 ? 'selected' : ''}}>Januari</option>
                            <option value="2" {{date('m') == 2 ? 'selected' : ''}}>Februari</option>
                            <option value="3" {{date('m') == 3 ? 'selected' : ''}}>Maret</option>
                            <option value="4" {{date('m') == 4 ? 'selected' : ''}}>April</option>
                            <option value="5" {{date('m') == 5 ? 'selected' : ''}}>Mei</option>
                            <option value="6" {{date('m') == 6 ? 'selected' : ''}}>Juni</option>
                            <option value="7" {{date('m') == 7 ? 'selected' : ''}}>Juli</option>
                            <option value="8" {{date('m') == 8 ? 'selected' : ''}}>Agustus</option>
                            <option value="9" {{date('m') == 9 ? 'selected' : ''}}>September</option>
                            <option value="10" {{date('m') == 10 ? 'selected' : ''}}>Oktober</option>
                            <option value="11" {{date('m') == 11 ? 'selected' : ''}}>November</option>
                            <option value="12" {{date('m') == 12 ? 'selected' : ''}}>Desember</option>
                        </select>
                    </div>
                    <div class="col-md-5 col-sm-6 mb-2">
                        Tahun:
                        <input type="number" id="select-tahun" class="form-control" value="{{date('Y')}}">
                    </div>
                    <div class="col-md-2 col-sm-12 mb-2">
                        <button type="button" class="btn btn-primary btn-sm" id="keuangan-bulanan">Check</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pemasukan</h5>
                        </div>
                        <div class="card-body">
                            Pemasukan: <h5 id="pemasukan-bulanan" class="text-success">0</h5>
                            Detail pemasukan:
                            <div id="detail-pemasukan">
                                -
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pengeluaran</h5>
                        </div>
                        <div class="card-body">
                            Pengeluaran: <h5 id="pengeluaran-bulanan" class="text-danger">0</h5>
                            Detail pengeluaran:
                            <div id="detail-pengeluaran">
                                -
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modal.dashboard')
@endsection
@section('after-script')
    <script src="{{asset('js/dashboard/index.js')}}"></script>
@endsection
