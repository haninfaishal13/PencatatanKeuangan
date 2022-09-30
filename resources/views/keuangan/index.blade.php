@extends('_layout.main')
@section('title', 'Keuangan')
@section('content')
    <div class="mb-3">
        <div class="d-flex">
            <h3 id="user">Daftar Keuangan</h3>
            <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#modal-tambah-category">Tambah Keuangan</button>
        </div>
    </div>

    <table class="table table-stripped">
        <thead>
            <th style="width:3%">No</th>
            <th>Tujuan</th>
            <th>Nominal</th>
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

    @include('modal.keuangan')
@endsection
@section('after-script')
    <script src="{{asset('js/keuangan/index.js')}}"></script>
@endsection
