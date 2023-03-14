@extends('layouts.admin.master')

@section('title')
    <title>MoonBook | Stok</title>
@endsection

@section('content')
    <div class="container" style="max-width: 1700px; min-height: 700px">
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
                <th scope="col">Stok</th>
                <th scope="col">İşlem</th>
            </tr>
            </thead>
            <tbody class="flex-row justify-content-center align-items-center">
            @foreach($stocks as $stock)
                <tr class="text-center h-100">
                    <td class="align-middle">{{ $stock->kitap->id }}</td>
                    <td class="px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="ratio3x2" style="width: 50px"
                             src="{{ asset('storage/saticilar/kitaplar/'. $stock->kitap->fotograf )}}"
                             alt="{{ $stock->kitap->adi }}"></td>
                    <td class="align-middle">{{ $stock->kitap->kategoriler->adi }}</td>
                    <td class="align-middle">{{ $stock->kitap->adi }}</td>
                    <td class="align-middle">{{ $stock->kitap->yazarlar->adi_soyadi }}</td>
                    <td class="align-middle">{{ $stock->kitap->yayin_evleri->adi }}</td>
                    <td class="align-middle px-5">{{ $stock->kitap->sayfa_sayisi }}</td>
                    <td class="align-middle px-5">{{ $stock->kitap->yayin_yili }}</td>
                    <td class="align-middle"
                        title="{{ $stock->kitap->aciklama }}">{{ \Illuminate\Support\Str::limit($stock->kitap->aciklama, 30) }}</td>
                    <td class="align-middle">₺{{ $stock->kitap->fiyat }}</td>
                    <form method="post" action="{{ route('seller.books.putStock', ['stock' => $stock->id]) }}"
                          onsubmit="return confirm('Stok Güncellendi!')"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <td class="align-middle">
                            <label for="stok_adeti" hidden></label>
                            <input type="text" class="form-control w-50 mx-auto text-center"
                                   id="stok_adeti"
                                   name="stok_adeti" value="{{ $stock->stok_adeti ?? 0}}">
                        </td>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-success"><i
                                        class="fa-solid fa-check"></i></button>
                        </td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
