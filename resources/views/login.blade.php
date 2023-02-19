<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MoonBook | Giriş Yap</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/admin/sb-admin-2.min.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/68b01077e6.js" crossorigin="anonymous"></script>

</head>

<body class="bg-gradient-danger">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-flex justify-content-center align-items-center">
                            <img style="width: 450px; height: 450px"
                                 src="{{Storage::url('public/logolar/moonbooklogo.png')}}" alt="moonbook">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Giriş Yap</h1>
                                </div>
                                <form method="post" action="{{ route('login') }}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email"
                                               name="email" aria-describedby="emailHelp" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="sifre"
                                               name="sifre" placeholder="Şifre">
                                    </div>
                                    @if(session()->has('danger'))
                                        <div class="alert alert-danger" style="border-radius: 25px" role="alert">
                                            {{session()->get('danger')}}
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-danger btn-user btn-block">
                                        Giriş Yap
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small text-danger" href="#">Şifremi Unuttun?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small text-danger" href="{{ route('register') }}">Hesap Oluştur!</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <a class="small text-danger" href="{{route('sellerLogin')}}">Satıcı Girişi Yap!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('css/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
