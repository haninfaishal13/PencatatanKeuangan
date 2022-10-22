<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/custom/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-free/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/select2/select2.min.css')}}">

    @yield('after-style')

    <title>
        @yield('title')
    </title>

</head>
<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light pt-3" style="background-color: #e3f2fd;">
            <div class="container">
                <a class="navbar-brand" id="">Pencatatan Keuangan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="navbar-menu">

                    </ul>
                    <div id="auth-button">
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
                        <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#register-modal">Register</button>
                    </div>

                </div>
            </div>
        </nav>
    </header>
    <section class="mt-3 container">
        @yield('content')
    </section>
</body>

<script src="{{asset('assets/js/jquery/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.min.js')}}"></script>
<script>
    var base_url = "{{url('/')}}"
</script>
<script src="{{asset('js/global.js')}}"></script>
    @yield('after-script')
</html>
