@extends('_layout.main')
@section('title', 'Kategori')
@section('content')
<div class="mb-3">
    <div class="d-flex">
        <h3 id="user">Kategori</h3>
        <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#modal-tambah-category">Tambah Kategori</button>
    </div>
</div>

<table class="table table-stripped">
    <thead>
        <th style="width:1%">No</th>
        <th>Nama</th>
        <th style="width:40%">Aksi</th>
    </thead>
    <tbody id="tb-category"></tbody>
</table>

@include('modal.category')
@include('modal.subcategory')

@endsection
@section('after-script')
    <script src="{{asset('js/kategori/index.js')}}"></script>
    <script src="{{asset('js/kategori/subcategory.js')}}"></script>
@endsection
