@extends('_layout.main')
@section('title', 'Welcome')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <img src="{{asset('assets/png/welcome-absensi.png')}}" alt="" class="img-fluid">
        </div>
        <div class="col-md-6 col-sm-12">
            <h4>Pencatatan Keuangan</h4>
            <p>Pantau dan kelola keuangan anda dengan aplikasi keuangan</p>
        </div>
    </div>
</div>

@include('modal.auth')
@endsection
@section('after-script')
    <script src="{{asset('js/auth.js')}}"></script>
@endsection
