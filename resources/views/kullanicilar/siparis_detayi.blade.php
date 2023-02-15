@php use Carbon\Carbon; @endphp
@extends('layouts.kullanicilar.master')

@section('title')
    <title>MoonBook | {{ $siparis->kod }}</title>
@endsection

@section('content')
    <div class="container my-5" style="max-width: 1450px">
        <h3><b><u>{{ $siparis->kod }}</u></b> Kodlu Sipariş</h3>
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
            @foreach($siparis->siparis_detaylari as $kitap)
                <tr class="text-center">
                    <td class="align-middle">{{ $kitap->kitap->id }}</td>
                    <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="ratio3x2" style="width: 70px"
                             src="{{ Storage::url('public/saticilar/kitaplar/'. $kitap->kitap->fotograf )}}"
                             alt="{{ $kitap->kitap->adi }}"></td>
                    <td class="align-middle">{{ $kitap->kitap->kategoriler->adi }}</td>
                    <td class="align-middle">{{ $kitap->kitap->adi }}</td>
                    <td class="align-middle"><a class="text-decoration-none" href="{{ route('yazar_kitaplari', $kitap->kitap->yazarlar->id) }}">{{ $kitap->kitap->yazarlar->adi_soyadi }}</a></td>
                    <td class="align-middle"><a class="text-decoration-none" href="{{ route('yayin_evleri_kitaplari', $kitap->kitap->yayin_evleri->id) }}">{{ $kitap->kitap->yayin_evleri->adi }}</a></td>
                    <td class="align-middle">{{ $kitap->kitap->sayfa_sayisi }}</td>
                    <td class="align-middle">{{ $kitap->kitap->yayin_yili }}</td>
                    <td class="align-middle"><a class="text-decoration-none" href="{{ route('saticilar', $kitap->kitap->saticilar->id) }}">{{ $kitap->kitap->saticilar->firma_adi }}</a></td>
                    <td class="align-middle">{{ $kitap->miktar }}</td>
                    <td class="align-middle">{{ '₺ '. $kitap->kitap->fiyat }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection