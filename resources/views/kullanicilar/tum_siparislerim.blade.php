@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.kullanicilar.master')

@section('title')
    <title>MoonBook | Tüm Siparişler</title>
@endsection

@section('content')
    <div class="container my-5">
        <h3>Tüm Siparişlerim ({{ $deactiveSepetler->count() ?? 0 }})</h3>
        <hr>
        @foreach($deactiveSepetler as $sepet)
            <div class="my-3">
                <div class="mb-5">
                    <div class="card shadow border-0" style="min-height: 170px; width: 100%">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-around">
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Sipariş Kodu</b></p>
                                    <p class="card-text">{{ $sepet->kod }}</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Siparis Tarihi</b></p>
                                    <p class="card-text">{{ Carbon::parse($sepet->updated_at)->format('d M Y') . ' - ' . $sepet->updated_at->diffForHumans() }}</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Siparis Özeti</b></p>
                                    <p class="card-text">{{ $sepet->sepetDetaylari->count() }} Kitap</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Alıcı</b></p>
                                    <p class="card-text">{{ $sepet->kullanicilar->adi_soyadi }}</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Tutar</b></p>
                                    <p class="card-text">
                                        @foreach($sepet->siparis->siparis_detaylari as $detay)
                                            ₺ {{ $detay->where('siparis_id', $sepet->siparis->id)->sum('fiyat') }}
                                            @break
                                        @endforeach
                                    </p>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('siparis_detayi', $sepet->siparis->id) }}" class="btn btn-warning">
                                        <b>Sipariş Detayı</b>
                                        <i class="fa-solid fa-chevron-down" style="margin-left: 5px"></i>
                                    </a>
                                </div>
                            </div>
                            <hr class="m-0 mb-3">
                            <div>
                                @foreach($sepet->sepetDetaylari as $detaylar)
                                    <img class="ratio3x2 mx-2" style="width: 50px; margin-right: 10px;"
                                         src="{{ \Illuminate\Support\Facades\Storage::url('public/saticilar/kitaplar/'. $detaylar->kitaplar->fotograf) }}"
                                         alt="{{ $detaylar->kitaplar->adi }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection