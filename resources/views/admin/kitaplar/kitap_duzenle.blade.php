@extends('layouts.admin.master')
@section('title')
    <title>MoonBook | Kitap Düzenle</title>
@endsection
@section('content')
    <div class="row justify-content-center flex-fill">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-1 my-5">
                <div class="card-body py-5 px-3">
                    <!-- Nested Row within Card Body -->
                    <form method="post" action="{{ route('satici.kitaplar.kitap_duzenle_put', $kitap->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <!-- Fotoğraf Yükle -->
                            <div class="col-lg-6 d-flex align-items-center">
                                <div class="container">
                                    <div class="row d-flex flex-column align-items-center">
                                        <div class="col-lg-12 d-flex mb-3" style="justify-content: center;">
                                            <div class="ratio-3x2" style="width: 300px;">
                                                <img
                                                    style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{ asset('storage/saticilar/kitaplar/'. $kitap->fotograf) }}"
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
                                                <h1 class="h4 text-gray-900 mb-4">Kitap Düzenle</h1>
                                            </div>

                                            <!-- Kategori ve Yazar -->
                                            <div class="form-group d-flex gap-3">

                                                <!-- Kategori -->
                                                <div class="col px-0">
                                                    <select name="kategori_id" id="kategori_id" class="form-control">
                                                        <option value="{{ $kitap->kategoriler->id }}"
                                                                selected>{{ $kitap->kategoriler->adi }}</option>
                                                        @foreach($kategoriler as $kategori)
                                                            <option value="{{$kategori->id}}"
                                                                    data-id="{{ $kategori->id }}">{{ $kategori->adi }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kategori_id')
                                                    <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                                    </div>
                                                    @enderror
                                                </div>

                                                <!-- Yazar -->
                                                <div class="col px-0">
                                                    <select name="yazar_id" id="yazar_id" class="form-control">
                                                        <option value="{{ $kitap->yazarlar->id }}"
                                                                selected>{{ $kitap->yazarlar->adi_soyadi }}</option>
                                                        @foreach($yazarlar as $yazar)
                                                            <option value="{{$yazar->id}}"
                                                                    data-id="{{ $yazar->id }}">{{ $yazar->adi_soyadi }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('yazar_id')
                                                    <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <!-- Kitap Adı ve Yayın Evi -->
                                            <div class="form-group d-flex gap-3">

                                                <!-- Kitap Adı -->
                                                <div class="col px-0">
                                                    <input type="text" class="form-control" id="adi"
                                                           name="adi" value="{{ $kitap->adi }}">
                                                    @error('adi')
                                                    <div class="text-sm text-red-400" style="color: red;">
                                                        <small>{{ $message }}</small></div>
                                                    @enderror
                                                </div>

                                                <!-- Yayın Evi -->
                                                <div class="col px-0">
                                                    <select name="yayin_evi_id" id="yayin_evi_id" class="form-control">
                                                        <option value="{{ $kitap->yayin_evleri->id }}"
                                                                selected>{{ $kitap->yayin_evleri->adi }}</option>
                                                        @foreach($yayin_evleri as $yayin_evi)
                                                            <option value="{{$yayin_evi->id}}"
                                                                    data-id="{{ $yayin_evi->id }}">{{ $yayin_evi->adi }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('yayin_evi_id')
                                                    <div class="text-sm text-red-400" style="color: red;">
                                                        <small>{{ $message }}</small></div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <!-- Sayfa Sayısı ve Yayın Yılı -->
                                            <div class="form-group d-flex gap-3">

                                                <!-- Sayfa Sayısı -->
                                                <div class="col px-0">
                                                    <input type="text" class="form-control" id="sayfa_sayisi"
                                                           name="sayfa_sayisi" value="{{ $kitap->sayfa_sayisi }}">
                                                </div>

                                                <!-- Yayın Yılı -->
                                                <div class="col px-0">
                                                    <input type="text" class="form-control" id="yayin_yili"
                                                           name="yayin_yili" value="{{ $kitap->yayin_yili }}">
                                                </div>

                                            </div>

                                            <!-- Açıklama -->
                                            <div class="form-group">
                                                <textarea class="form-control" style="resize: none" name="aciklama"
                                                          id="aciklama" cols="30"
                                                          rows="5">{{ $kitap->aciklama }}</textarea>
                                            </div>

                                            <!-- Fiyat -->
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="fiyat"
                                                       name="fiyat" value="{{ $kitap->fiyat }}">
                                                @error('fiyat')
                                                <div class="text-sm text-red-400" style="color: red;">
                                                    <small>{{ $message }}</small></div>
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
    <script src="{{ asset('js/fotografekle.js') }}"></script>
@endsection
