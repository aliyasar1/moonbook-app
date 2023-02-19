@extends('layouts.admin.master')
@section('title')
    <title>MoonBook | Kitaplar</title>
@endsection
@section('content')
    <div class="flex m-2 mx-4 p-2" style="font-size: 24px">
        {{ 'Kitaplar ('. count($kitaplar) . ' adet)' }}
    </div>
    <div class="gap-2 g-col-4 d-flex flex-wrap"
         style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
        @foreach($kitaplar as $kitap)
            <div class="max-w-12xl sm:px-6 lg:px-8 mb-3" style="margin-left: 30px">
                <div class="card" style="width: 15rem; align-items: center; padding: 1.25rem;">
                    <div class="ratio-3x2 mb-3" style="width: 150px; height: 200px;">
                        <img class="w-100 h-100"
                             src="{{ asset('storage/saticilar/kitaplar/'. $kitap->fotograf ) }}" alt="Card image cap">
                    </div>
                    <div class="card-body p-0 w-100 text-truncate">
                        <h4 class="card-title mb-0"
                            style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                            title="{{ $kitap->adi }}">{{ $kitap->adi }}</h4>
                        <p class="card-text mb-2" style="font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $kitap->yazarlar->adi_soyadi }}">{{ $kitap->yazarlar->adi_soyadi }}
                            <span title="{{$kitap->yayin_evleri->adi }}"> {{ ' - '. $kitap->yayin_evleri->adi }} </span></p>
                        <p class="card-text mb-2"
                           style="font-size: 24px;"><b>{{'₺'. $kitap->fiyat }}</b></p>
                        <p class="card-text mb-3"
                           style="font-size: 12px;"> {{ $kitap->kategoriler->adi .' - '. '('. $kitap->sayfa_sayisi . ' sayfa' .') - ('. $kitap->stok->stok_adeti . ' adet)' }} </p>

                        <div class="flex-fill d-flex gap-3 mb-0 justify-content-center">
                            <a href="{{ route('seller.books.editBook', $kitap->id) }}"
                               class="btn btn-success">Düzenle</a>
                            <form method="POST" action="{{ route('seller.books.deleteBook', $kitap->id) }}"
                                  onsubmit="return confirm(' {{ $kitap->adi }} Adlı Kitap Silinecek, Emin Misin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Sil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
