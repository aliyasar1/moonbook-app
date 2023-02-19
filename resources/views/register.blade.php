<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MoonBook | Hesap Oluştur</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/admin/sb-admin-2.min.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/68b01077e6.js" crossorigin="anonymous"></script>

</head>

<body class="bg-gradient-danger">

<div class="row justify-content-center flex-fill">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-1 my-5">
            <div class="card-body py-5 px-3">
                <!-- Nested Row within Card Body -->
                <form method="post" action="{{ route('postRegister') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <!-- Fotoğraf Yükle -->
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="container">
                                <div class="row d-flex flex-column align-items-center">
                                    <div class="col-lg-12 d-flex mb-3" style="justify-content: center;">
                                        <div class="ratio-1x1" style="width: 300px; height: 300px">
                                            <img
                                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%"
                                                    src="{{ asset('storage/musteriler/default.png') }}"
                                                    alt="Varsayılan Fotoğraf"
                                                    class="preview-image">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="file" id="fotograf" name="fotograf" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="container">
                                <div class="row d-flex flex-column align-items-center">
                                    <div class="col-lg-8">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Hesap Oluştur</h1>
                                        </div>

                                        <!-- Adı Soyadı -->
                                        <div class="form-group d-flex gap-3">
                                            <div class="col px-0">
                                                <input type="text" class="form-control" id="adi_soyadi"
                                                       name="adi_soyadi" placeholder="Ad Soyad">
                                                @error('adi_soyadi')
                                                <div class="text-sm text-red-400" style="color: red;">
                                                    <small>{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                            <div class="col px-0">
                                                <div class="input-group mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">@</div>
                                                    </div>
                                                    <input type="text" class="form-control text-lowercase"
                                                           id="kullanici_adi"
                                                           name="kullanici_adi" placeholder="Kullanıcı Adı">
                                                </div>
                                                @error('kullanici_adi')
                                                <div class="text-sm text-red-400" style="color: red;">
                                                    <small>{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Telefon Numarası -->
                                        <div class="form-group d-flex gap-3">
                                            <div class="col px-0">
                                                <input type="email" class="form-control text-lowercase" id="email"
                                                       name="email" aria-describedby="emailHelp"
                                                       placeholder="Email">
                                                @error('email')
                                                <div class="text-sm text-red-400 font" style="color: red;">
                                                    <small>{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                            <div class="col px-0">
                                                <input type="text" class="form-control" id="tel_no"
                                                       name="tel_no" placeholder="05XXXXXXXXX">
                                                @error('tel_no')
                                                <div class="text-sm text-red-400" style="color: red;">
                                                    <small>{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Şifre -->
                                        <div class="form-group d-flex gap-3">
                                            <div class="col px-0">
                                                <input type="password" class="form-control" id="sifre"
                                                       name="sifre" placeholder="Şifre">
                                                @error('sifre')
                                                <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col px-0">
                                                <input type="password" class="form-control" id="sifre_tekrar"
                                                       name="sifre_tekrar" placeholder="Şifre Tekrar">
                                                @error('sifre_tekrar')
                                                <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- İl ve İlçe -->
                                        <div class="form-group d-flex gap-3">
                                            <div class="col px-0">
                                                <select name="il_id" id="il_id" class="form-control">
                                                    <option value="" selected>Bir İl Seçiniz...</option>
                                                    @foreach($iller as $il)
                                                        <option value="{{$il->id}}"
                                                                data-id="{{ $il->id }}">{{ $il->il }}</option>
                                                    @endforeach
                                                </select>
                                                @error('il_id')
                                                <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col px-0">
                                                <select name="ilce_id" id="ilce_id" class="form-control">
                                                    <option value="" selected>Önce İl Seçiniz...</option>
                                                </select>
                                                @error('ilce_id')
                                                <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Adres -->
                                        <div class="form-group">
                                                <textarea class="form-control" style="resize: none" name="adres"
                                                          id="adres" cols="30"
                                                          rows="5" placeholder="Adres..."></textarea>
                                            @error('adres')
                                            <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                            </div>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                                class="btn btn-danger btn-user btn-block">
                                            Hesap Oluştur
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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

<script>
    $(document).on('change', '#il_id', function () {
        let ilID = $(this).find('option:selected').data('id');
        let $ilce = $('#ilce_id');


        $.ajax({
            type: 'post',
            url: "{{ route('DistrictByCity') }}",
            dataType: 'json',
            data: {
                'il_id': ilID
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                console.log(res)
                $ilce.find('option').remove().end().append(new Option('Seçiniz...', '')).val('');

                $.each(res, function (index, item) {
                    $ilce.append(new Option(item.ilce, item.id));
                });
            }
        });
    });

</script>

<script src="{{ asset('js/fotografekle.js') }}"></script>

</body>

</html>
