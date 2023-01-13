@extends('layouts.kullanicilar.master')

@section('title')
    <title>MoonBook | Kitaplar</title>
    @endsection
@section('content')
    <div class="container my-5">
        <ul class="nav gap-3 d-flex justify-content-center my-3 ">
            @foreach($kategoriler as $kategori)
                <li class="nav-item">
                    <a class="btn bg-warning" href="{{ route('kitaplar.kategori', ['kategori' => $kategori->id]) }}">{{ $kategori->adi }}</a>
                </li>
            @endforeach
        </ul>
        <div class="gap-3 g-col-4 d-flex flex-wrap"
             style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            @foreach($kitaplar as $kitap)
                <div class="max-w-12xl sm:px-6 lg:px-8" style="margin-right: 5px">
                    <div class="card" style="width: 15rem; align-items: center; padding: 1.25rem;">
                        <div class="fvrt-btn bg-warning d-flex justify-content-center align-items-center">
                            <i class="fvrt fa-regular fa-heart" style="font-size: 18px" data-selected-value="{{ $kitap->id }}"></i></div>
                        <div class="ratio-3x2 mb-3" style="width: 150px; height: 200px;">
                            <img class="w-100 h-100"
                                 src="{{ asset('storage/saticilar/kitaplar/'. $kitap->fotograf ) }}"
                                 alt="Card image cap">
                        </div>
                        <div class="card-body p-0 w-100 text-truncate">
                            <p class="card-text mb-3" style="color: black">
                                <span class="badge text-decoration-none text-bg-warning"
                                      href="#">{{ $kitap->kategoriler->adi }}</span>
                            </p>
                            <h4 class="card-title mb-0"
                                style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                title="{{ $kitap->adi }}">{{ $kitap->adi }}</h4>
                            <p class="card-text mb-2"
                               style="font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                               title="{{ $kitap->yazarlar->adi_soyadi }}">{{ $kitap->yazarlar->adi_soyadi }}
                                <span
                                    title="{{$kitap->yayin_evleri->adi }}"> {{ ' - '. $kitap->yayin_evleri->adi }} </span>
                            </p>
                            <p class="card-text mb-1"
                               style="font-size: 24px;"><b>{{'₺'. $kitap->fiyat }}</b></p>
                            <div class="feature text-white rounded-3 mb-1">
                                <p class="card-text mb-3" style="color: black">
                                    Satıcı : <a class="text-decoration-none"
                                                href="#">{{ $kitap->saticilar->firma_adi }}</a>
                                </p>
                            </div>
                            <div class="flex-fill d-flex gap-3 mb-0 justify-content-center">
                                <a href="{{ route('kitap_incele', $kitap->id) }}" class="btn btn-warning w-50">İncele</a>
                                <a href="#" class="btn btn-warning w-50">Sepete Ekle</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
           $(".fvrt").click(function () {
               $(".fvrt").removeClass('fa-regular').addClass('fa-solid');
           });
        });
    </script>
@endsection
