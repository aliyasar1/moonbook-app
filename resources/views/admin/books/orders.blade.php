@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Storage;
@endphp
@extends('layouts.admin.master')

@section('title')
    <title>MoonBook | Siparişler</title>
@endsection

@section('content')
    <div class="container" style="max-width: 1600px; min-height: 700px">
        @foreach($orders as $order)
            <div class="my-3">
                <div class="mb-5">
                    <div class="card shadow border-0" style="min-height: 170px; width: 100%">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-around">
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Sipariş Kodu</b></p>
                                    <p class="card-text">{{$order->kod}}</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Siparis Tarihi</b></p>
                                    <p class="card-text">{{  Carbon::parse($order->created_at)->format('d M Y') . ' - ' . $order->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Siparis Özeti</b></p>
                                    <p class="card-text">
                                        @foreach($order->siparis_detaylari as $detail)
                                            {{ $detail->where('siparis_id', $order->id)->where('status_id', $status->id)->whereHas('kitap', function ($q){ $q->where('satici_id', Auth::user()->id);})->count() }}
                                            Kitap,
                                            {{ $detail->where('siparis_id', $order->id)->where('status_id', $status->id)->whereHas('kitap', function ($q){ $q->where('satici_id', Auth::user()->id);})->sum('miktar') }}
                                            Adet
                                            @break
                                        @endforeach
                                    </p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Alıcı</b></p>
                                    <p class="card-text">{{ $order->sepet->kullanicilar->adi_soyadi }}</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Tutar</b></p>
                                    <p class="card-text">
                                        @foreach($order->siparis_detaylari as $detail)
                                            ₺ {{ $detail->where('siparis_id', $order->id)->where('status_id', $status->id)->whereHas('kitap', function ($q){ $q->where('satici_id', Auth::user()->id);})->sum('fiyat') }}
                                            @break
                                        @endforeach
                                    </p>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('seller.orderDetail', [$status->id, $order->id]) }}"
                                       class="btn btn-danger">
                                        <b>Sipariş Detayı</b>
                                        <i class="fa-solid fa-chevron-down" style="margin-left: 5px"></i>
                                    </a>
                                </div>
                            </div>
                            <hr class="m-0 mb-2">

                            <div>
                                @foreach($order->siparis_detaylari as $detail)
                                    @if($detail->kitap->satici_id == Auth::user()->id && $detail->status_id == $status->id)
                                        <img class="ratio3x2 mx-2" style="width: 50px; margin-right: 10px;"
                                             src="{{ Storage::url('public/saticilar/kitaplar/'. $detail->kitap->fotograf) }}"
                                             alt="asd">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection