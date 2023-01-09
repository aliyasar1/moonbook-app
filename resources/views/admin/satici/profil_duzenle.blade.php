@extends('layouts.admin.master')

@section('title')
    <title>MoonBook | Profil Düzenle</title>
@endsection

@section('content')
    <div class="row justify-content-center flex-fill">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-1 my-5">
                <div class="card-body py-5 px-3">
                    <!-- Nested Row within Card Body -->
                    <form method="post" action="{{ route('satici.profil_duzenle_put', $user->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <!-- Fotoğraf Yükle -->
                            <div class="col-lg-6 d-flex align-items-center">
                                <div class="container">
                                    <div class="row d-flex flex-column align-items-center">
                                        <div class="col-lg-12 d-flex mb-3" style="justify-content: center;">
                                            <div class="ratio-1x1" style="width: 300px; height: 300px">
                                                <img
                                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%"
                                                    src="{{ asset('storage/saticilar/'. $user->fotograf) }}"
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
                                                <h1 class="h4 text-gray-900 mb-4">Profil Düzenle</h1>
                                            </div>

                                            <!-- Firma Adı ve VKN/TCKN -->
                                            <div class="form-group d-flex gap-3">
                                                <div class="col px-0">
                                                    <input type="text" class="form-control" id="firma_adi"
                                                           name="firma_adi" value="{{ $user->firma_adi }}">
                                                    @error('firma_adi')
                                                    <div class="text-sm text-red-400" style="color: red;">
                                                        <small>{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                                <div class="col px-0">
                                                    <input type="text" class="form-control" id="tckn"
                                                           name="tckn" value="{{ $user->tckn }}">
                                                    @error('tckn')
                                                    <div class="text-sm text-red-400" style="color: red;">
                                                        <small>{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Adı Soyadı -->
                                            <div class="form-group d-flex gap-3">
                                                <div class="col px-0">
                                                    <input type="text" class="form-control" id="adi_soyadi"
                                                           name="adi_soyadi" value="{{ $user->adi_soyadi }}">
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
                                                               name="kullanici_adi" value="{{ $user->kullanici_adi }}">
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
                                                           value="{{ $user->email }}">
                                                    @error('email')
                                                    <div class="text-sm text-red-400 font" style="color: red;">
                                                        <small>{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                                <div class="col px-0">
                                                    <input type="text" class="form-control" id="tel_no"
                                                           name="tel_no" value="{{ $user->tel_no }}">
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
                                                           name="sifre" value="{{ base64_decode($user->sifre) }}">
                                                    @error('sifre')
                                                    <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col px-0">
                                                    <input type="password" class="form-control" id="sifre_tekrar"
                                                           name="sifre_tekrar" value="{{ base64_decode($user->sifre_tekrar) }}">
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
                                                        <option value="{{ $user->il_id }}" selected>{{ $user->iller->il }}</option>
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
                                                        <option value="{{ $user->ilce_id }}" selected>{{ $user->ilceler->ilce }}</option>
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
                                                          rows="5">{{ $user->adres }}</textarea>
                                                @error('adres')
                                                <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                            <button type="submit"
                                                    class="btn btn-danger btn-user btn-block">
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
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/il-ilce-secim.js') }}"></script>
    <script src="{{ asset('js/fotografekle.js') }}"></script>
@endsection
