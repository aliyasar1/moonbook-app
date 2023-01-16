@extends('layouts.kullanicilar.master')

@section('content')
    <div class="container my-5">
        <div class="row d-flex flex-column align-items-center">
            <div class="col-lg-12 d-flex mb-3" style="justify-content: center;">
                <div class="d-flex justify-content-center align-items-center"
                     style="flex: 1; border: 1px solid black;">
                    <div class="ratio-3x2 my-2 mx-2 d-flex justify-content-center align-items-center"
                         style="width: 300px">
                        <img
                                style="width: 100%; height: 100%; object-fit: cover;"
                                src="{{ \Illuminate\Support\Facades\Storage::url('public/saticilar/'. $satici->fotograf) }}"
                                alt="Varsayılan Fotoğraf"
                                class="preview-image">
                    </div>
                </div>
                <div class="mx-4 d-block justify-content-around" style="flex: 2;">
                    <h2>{{ $satici->firma_adi }} <small>({{ $satici->kullanici_adi }})</small></h2>
                    <hr>
                    <div class="d-flex justify-content-lg-between">
                        <p class="d-inline"><b>Yetkili: </b>{{ $satici->adi_soyadi }}</p>
                        <p class="d-inline"><b>Telefon No: </b>{{ $satici->tel_no }}</p>
                        <p class="d-inline"><b>E-posta: </b><a href="mailto:{{ $satici->email }}">{{ $satici->email }}</a></p>
                    </div>
                    <p><b>Adres: </b>{{ $satici->adres }}</p>
                </div>
            </div>
            <h2 class="mt-3">Kitaplar</h2>
            <hr>
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
                                   title="{{ $kitap->yazarlar->adi_soyadi }}"><a class="text-decoration-none" href="{{ route('yazar_kitaplari', $kitap->yazarlar->id) }}">{{ $kitap->yazarlar->adi_soyadi }}</a>
                                    <span
                                            title="{{$kitap->yayin_evleri->adi }}"> <a href="{{ route('yayin_evleri_kitaplari', $kitap->yayin_evleri->id) }}" class="text-decoration-none">{{ ' - '. $kitap->yayin_evleri->adi }}</a> </span>
                                </p>
                                <p class="card-text mb-1"
                                   style="font-size: 24px;"><b>{{'₺'. $kitap->fiyat }}</b></p>
                                <div class="feature text-white rounded-3 mb-1">
                                    <p class="card-text mb-3" style="color: black">
                                        Satıcı : <a class="text-decoration-none"
                                                    href="{{ route('saticilar', $kitap->saticilar->id) }}">{{ $kitap->saticilar->firma_adi }}</a>
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