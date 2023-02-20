@php use Carbon\Carbon; @endphp
@extends('layouts.customers.master')

@section('title')
    <title>MoonBook | {{ $order->kod }}</title>
@endsection

@section('content')
    <div class="container my-5" style="max-width: 1450px">
        <h3><b><u>{{ $order->kod }}</u></b> Kodlu Sipariş</h3>
        <hr>
        <table class="table" style="border: 1px #f4b122">
            <thead class="bg-warning text-center">
            <tr>
                <th scope="col">Kitap ID</th>
                <th scope="col">Fotoğraf</th>
                <th scope="col">Kategori</th>
                <th scope="col">Kitap Adı</th>
                <th scope="col">Yazar</th>
                <th scope="col">Yayın Evi</th>
                <th scope="col">Sayfa Sayısı</th>
                <th scope="col">Yayın Yılı</th>
                <th scope="col">Satıcı</th>
                <th scope="col">Miktar</th>
                <th scope="col">Fiyat</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->siparis_detaylari as $detail)
                <tr class="text-center">
                    <td class="align-middle">{{ $detail->kitap->id }}</td>
                    <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="ratio3x2" style="width: 70px"
                             src="{{ Storage::url('public/saticilar/kitaplar/'. $detail->kitap->fotograf )}}"
                             alt="{{ $detail->kitap->adi }}"></td>
                    <td class="align-middle">{{ $detail->kitap->kategoriler->adi }}</td>
                    <td class="align-middle">{{ $detail->kitap->adi }}</td>
                    <td class="align-middle"><a class="text-decoration-none"
                                                href="{{ route('writerBooks', $detail->kitap->yazarlar->id) }}">{{ $detail->kitap->yazarlar->adi_soyadi }}</a>
                    </td>
                    <td class="align-middle"><a class="text-decoration-none"
                                                href="{{ route('publishingHousesBooks', $detail->kitap->yayin_evleri->id) }}">{{ $detail->kitap->yayin_evleri->adi }}</a>
                    </td>
                    <td class="align-middle">{{ $detail->kitap->sayfa_sayisi }}</td>
                    <td class="align-middle">{{ $detail->kitap->yayin_yili }}</td>
                    <td class="align-middle"><a class="text-decoration-none"
                                                href="{{ route('sellers', $detail->kitap->saticilar->id) }}">{{ $detail->kitap->saticilar->firma_adi }}</a>
                    </td>
                    <td class="align-middle">{{ $detail->miktar }}</td>
                    <td class="align-middle">{{ '₺ '. $detail->kitap->fiyat }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection