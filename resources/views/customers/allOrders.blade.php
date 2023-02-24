@php use App\Models\OrderStatuses;use Illuminate\Support\Carbon; @endphp
@extends('layouts.customers.master')

@section('title')
    <title>MoonBook | Tüm Siparişler</title>
@endsection

@section('content')
    <div class="container my-5">
        <h3>Tüm Siparişlerim ({{ $orders->count() ?? 0 }})</h3>
        <hr>
        @foreach($orders as $order)
            <div class="my-3">
                <div class="mb-5">
                    <div class="card shadow border-0" style="min-height: 170px; width: 100%">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-around">
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Sipariş Kodu</b></p>
                                    <p class="card-text">{{ $order->kod }}</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Siparis Tarihi</b></p>
                                    <p class="card-text">{{ Carbon::parse($order->sepet->updated_at)->format('d M Y') . ' - ' . $order->sepet->updated_at->diffForHumans() }}</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Siparis Özeti</b></p>
                                    <p class="card-text">{{ $order->siparis_detaylari->count() }} Kitap</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Alıcı</b></p>
                                    <p class="card-text">{{ $order->sepet->kullanicilar->adi_soyadi }}</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p class="card-text m-0"><b>Tutar</b></p>
                                    <p class="card-text">
                                        @foreach($order->siparis_detaylari as $detail)
                                            ₺ {{ $detail->where('siparis_id', $order->id)->sum('fiyat') }}
                                            @break
                                        @endforeach
                                    </p>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('orderDetail', $order->id) }}"
                                       class="btn btn-warning">
                                        <b>Sipariş Detayı</b>
                                        <i class="fa-solid fa-chevron-down" style="margin-left: 5px"></i>
                                    </a>
                                </div>
                            </div>
                            <hr class="m-0 mb-2">
                            <div class="my-2 px-2 d-flex gap-2">
                                <p>Sipariş Durumu: </p>
                                <label hidden>
                                    @foreach($order->siparis_detaylari as $detail)
                                        {{ $orderStatus = $detail->where('siparis_id', $order->id)->min('status_id') }}
                                        @break
                                    @endforeach
                                </label>
                                <p class="text-success">
                                    <b>
                                        <i class="{{ OrderStatuses::ORDER_STATUS_ICON[$orderStatus] ?? OrderStatuses::ORDER_STATUS_ICON[1] }}"></i>
                                        {{ OrderStatuses::ORDER_STATUS[$orderStatus] ?? OrderStatuses::ORDER_STATUS[1] }}
                                    </b>
                                </p>
                            </div>
                            <div>
                                @foreach($order->siparis_detaylari as $detail)
                                    <img class="ratio3x2 mx-2" style="width: 50px; margin-right: 10px;"
                                         src="{{ \Illuminate\Support\Facades\Storage::url('public/saticilar/kitaplar/'. $detail->kitap->fotograf) }}"
                                         alt="{{ $detail->kitap->adi }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection