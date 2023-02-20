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
                    <form method="post" action="{{ route('seller.books.putEditBook', $book->id) }}"
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
                                                        src="{{ asset('storage/saticilar/kitaplar/'. $book->fotograf) }}"
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
                                                    <label for="kategori_id" class="mb-0" style="font-size: 14px">Kategori</label><select
                                                            name="kategori_id" id="kategori_id" class="form-control">
                                                        <option value="{{ $book->kategoriler->id }}"
                                                                selected>{{ $book->kategoriler->adi }}</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}"
                                                                    data-id="{{ $category->id }}">{{ $category->adi }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kategori_id')
                                                    <div class="mt-0" style="color: red;"><small>{{ $message }}</small>
                                                    </div>
                                                    @enderror
                                                </div>

                                                <!-- Yazar -->
                                                <div class="col px-0">
                                                    <label for="yazar_id" class="mb-0"
                                                           style="font-size: 14px">Yazar</label><select name="yazar_id"
                                                                                                        id="yazar_id"
                                                                                                        class="form-control">
                                                        <option value="{{ $book->yazarlar->id }}"
                                                                selected>{{ $book->yazarlar->adi_soyadi }}</option>
                                                        @foreach($writers as $writer)
                                                            <option value="{{$writer->id}}"
                                                                    data-id="{{ $writer->id }}">{{ $writer->adi_soyadi }}</option>
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
                                                    <label for="adi" class="mb-0" style="font-size: 14px">Kitap
                                                        Adı</label><input type="text" class="form-control" id="adi"
                                                                          name="adi" value="{{ $book->adi }}">
                                                    @error('adi')
                                                    <div class="text-sm text-red-400" style="color: red;">
                                                        <small>{{ $message }}</small></div>
                                                    @enderror
                                                </div>

                                                <!-- Yayın Evi -->
                                                <div class="col px-0">
                                                    <label for="yayin_evi_id" class="mb-0" style="font-size: 14px">Yayın
                                                        Evi</label><select name="yayin_evi_id" id="yayin_evi_id"
                                                                           class="form-control">
                                                        <option value="{{ $book->yayin_evleri->id }}"
                                                                selected>{{ $book->yayin_evleri->adi }}</option>
                                                        @foreach($publishingHouses as $publishingHouse)
                                                            <option value="{{$publishingHouse->id}}"
                                                                    data-id="{{ $publishingHouse->id }}">{{ $publishingHouse->adi }}</option>
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
                                                    <label for="sayfa_sayisi" class="mb-0" style="font-size: 14px">Sayfa
                                                        Sayısı</label><input type="text" class="form-control"
                                                                             id="sayfa_sayisi"
                                                                             name="sayfa_sayisi"
                                                                             value="{{ $book->sayfa_sayisi }}">
                                                </div>

                                                <!-- Yayın Yılı -->
                                                <div class="col px-0">
                                                    <label for="yayin_yili" class="mb-0" style="font-size: 14px">Yayın
                                                        Yılı</label><input type="text" class="form-control"
                                                                           id="yayin_yili"
                                                                           name="yayin_yili"
                                                                           value="{{ $book->yayin_yili }}">
                                                </div>

                                            </div>

                                            <!-- Açıklama -->
                                            <div class="form-group">
                                                <label for="aciklama" class="mb-0"
                                                       style="font-size: 14px">Açıklama</label><textarea
                                                        class="form-control" style="resize: none" name="aciklama"
                                                        id="aciklama" cols="30"
                                                        rows="5">{{ $book->aciklama }}</textarea>
                                            </div>

                                            <!-- Fiyat -->
                                            <div class="form-group">
                                                <label for="fiyat" class="mb-0"
                                                       style="font-size: 14px">Fiyat</label><input type="text"
                                                                                                   class="form-control"
                                                                                                   id="fiyat"
                                                                                                   name="fiyat"
                                                                                                   value="{{ $book->fiyat }}">
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
