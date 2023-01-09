<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>403 - Yetkisiz Giriş!</title>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/admin/sb-admin-2.css/sb-admin-2.min.css')}}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/68b01077e6.js" crossorigin="anonymous"></script>

</head>

<body>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="403">403</div>
        <p class="lead text-gray-800 mb-5">Giriş İzniniz Yoktur.</p>
        <p class="text-gray-500 mb-0">Bu alana girebilmeniz için satıcı olmanız gerekmektedir.</p>
        <a href="/">&larr; Geri Dön</a>
    </div>

</div>
<!-- /.container-fluid -->
</body>

</html>
