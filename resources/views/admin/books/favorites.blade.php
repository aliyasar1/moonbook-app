@extends('layouts.admin.master')

@section('title')
    <title>MoonBook | Favoridekiler</title>
@endsection

@section('content')
    <div class="mx-4" style="max-width: 1600px; min-height: 700px">
        <table class="table">
            <thead class="bg-danger text-white text-center">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Fotoğraf</th>
                <th scope="col">Kategori</th>
                <th scope="col">Kitap Adı</th>
                <th scope="col">Yazar</th>
                <th scope="col">Yayın Evi</th>
                <th scope="col">Sayfa Sayısı</th>
                <th scope="col">Yayın Yılı</th>
                <th scope="col">Açıklama</th>
                <th scope="col">Fiyat</th>
                <th scope="col">Favori Sayısı</th>
            </tr>
            </thead>
            <tbody class="flex-row justify-content-center align-items-center">
            @foreach($favorites as $favorite)
                <tr class="text-center h-100">
                    <td class="align-middle">{{ $favorite->kitaplar->id }}</td>
                    <td class="px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="ratio3x2" style="width: 60px"
                             src="{{ asset('storage/saticilar/kitaplar/'. $favorite->kitaplar->fotograf )}}"
                             alt="{{ $favorite->kitaplar->adi }}"></td>
                    <td class="align-middle">{{ $favorite->kitaplar->kategoriler ? ($favorite->kitaplar->kategoriler->adi ?? '') : '' }}</td>
                    <td class="align-middle">{{ $favorite->kitaplar->adi }}</td>
                    <td class="align-middle">{{ $favorite->kitaplar->yazarlar->adi_soyadi }}</td>
                    <td class="align-middle">{{ $favorite->kitaplar->yayin_evleri->adi }}</td>
                    <td class="align-middle">{{ $favorite->kitaplar->sayfa_sayisi }}</td>
                    <td class="align-middle">{{ $favorite->kitaplar->yayin_yili }}</td>
                    <td class="align-middle"
                        title="{{ $favorite->kitaplar->aciklama }}">{{ \Illuminate\Support\Str::limit($favorite->kitaplar->aciklama, 30) }}</td>
                    <td class="align-middle">{{ '₺ '. $favorite->kitaplar->fiyat }}</td>
                    <td class="align-middle"><b>{{ $favorite->miktar }}</b></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection