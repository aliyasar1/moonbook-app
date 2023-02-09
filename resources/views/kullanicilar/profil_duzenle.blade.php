@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.kullanicilar.master')

@section('title')
    <title>MoonBook | Profil Düzenle</title>
@endsection

@section('content')
    <div class="container my-5">
        <div class="card">
            <form method="post" action="{{ route('profil_duzenle_put', Auth::user()->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body d-flex justify-content-center align-items-center">
                    <!-- Fotoğraf Yükle -->
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="container">
                            <div class="row d-flex flex-column align-items-center">
                                <div class="col-lg-12 d-flex mb-3" style="justify-content: center;">
                                    <div class="ratio-1x1" style="width: 300px; height: 300px">
                                        <img
                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%"
                                                src="{{ asset('storage/musteriler/'. $user->fotograf) }}"
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
                                <div class="col-lg-10">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Profil Düzenle</h1>
                                    </div>

                                    <!-- Adı Soyadı ve Kullanıcı Adı -->
                                    <div class="form-group d-flex gap-3 mb-3">
                                        <div class="col px-0">
                                            <label for="adi_soyadi">Adı Soyadı</label>
                                            <input type="text" class="form-control" id="adi_soyadi"
                                                   name="adi_soyadi" value="{{ $user->adi_soyadi }}">
                                            @error('adi_soyadi')
                                            <div class="text-sm text-red-400" style="color: red;">
                                                <small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                        <div class="col px-0">
                                            <label for="kullanici_adi"> Kullanıcı Adı</label>
                                            <div class="input-group mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">@</div>
                                                </div>
                                                <input type="text" class="form-control text-lowercase"
                                                       id="kullanici_adi"
                                                       name="kullanici_adi" value="{{ $user->kullanici_adi }}">
                                            </div>
                                            @error('kullanici_adi')
                                            <div class="text-sm text-red-400" style="color: red;">
                                                <small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email ve Telefon No -->
                                    <div class="form-group d-flex gap-3 mb-3">
                                        <div class="col px-0">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control text-lowercase" id="email"
                                                   name="email" aria-describedby="emailHelp"
                                                   value="{{ $user->email }}">
                                            @error('email')
                                            <div class="text-sm text-red-400 font" style="color: red;">
                                                <small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                        <div class="col px-0">
                                            <label for="tel_no">Telefon No</label>
                                            <input type="text" class="form-control" id="tel_no"
                                                   name="tel_no" value="{{ $user->tel_no }}">
                                            @error('tel_no')
                                            <div class="text-sm text-red-400" style="color: red;">
                                                <small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Şifre -->
                                    <div class="form-group d-flex gap-3 mb-3">
                                        <div class="col px-0">
                                            <label for="sifre">Şifre</label>
                                            <input type="password" class="form-control" id="sifre"
                                                   name="sifre" value="{{ base64_decode($user->sifre) }}">
                                            @error('sifre')
                                            <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col px-0">
                                            <label for="sifre_tekrar">Şifre Tekrarı</label>
                                            <input type="password" class="form-control" id="sifre_tekrar"
                                                   name="sifre_tekrar" value="{{ base64_decode($user->sifre_tekrar) }}">
                                            @error('sifre_tekrar')
                                            <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- İl ve İlçe -->
                                    <div class="form-group d-flex gap-3 mb-3">
                                        <div class="col px-0">
                                            <label for="il_id">İl</label>
                                            <select name="il_id" id="il_id" class="form-control">
                                                <option value="{{ $user->il_id }}"
                                                        selected>{{ $user->iller->il }}</option>
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
                                            <label for="ilce_id">İlçe</label>
                                            <select name="ilce_id" id="ilce_id" class="form-control">
                                                <option value="{{ $user->ilce_id }}"
                                                        selected>{{ $user->ilceler->ilce }}</option>
                                            </select>
                                            @error('ilce_id')
                                            <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Adres -->
                                    <div class="form-group mb-3">
                                        <label for="adres">Adres</label>
                                        <textarea class="form-control" style="resize: none" name="adres"
                                                  id="adres" cols="30"
                                                  rows="5">{{ $user->adres }}
                                    </textarea>
                                        @error('adres')
                                        <div class="mt-0" style="color: red;">
                                            <small>{{ $message }}</small>
                                        </div>
                                        @enderror
                                    </div>

                                    <button type="submit"
                                            class="btn btn-danger">
                                        Düzenle
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).on('change', '#il_id', function () {
            let ilID = $(this).find('option:selected').data('id');
            let $ilce = $('#ilce_id');


            $.ajax({
                type: 'post',
                url: "{{ route('ilce_by_il') }}",
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
@endsection
