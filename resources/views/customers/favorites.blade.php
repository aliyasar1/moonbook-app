@extends('layouts.customers.master')

@section('title')
    <title>MoonBook | Favoriler</title>
@endsection

@section('content')
    <div class="container my-5" style="max-width: 1450px;">
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
                <th scope="col">Fiyat</th>
                <th scope="col">Favori</th>
            </tr>
            </thead>
            <tbody>
            @foreach($favoriKitaplar as $favkitap)
                <tr class="text-center">
                    <td class="align-middle">{{ $favkitap->kitaplar->id }}</td>
                    <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="ratio3x2" style="width: 70px"
                             src="{{ Storage::url('public/saticilar/kitaplar/'. $favkitap->kitaplar->fotograf )}}"
                             alt="{{ $favkitap->kitaplar->adi }}"></td>
                    <td class="align-middle">{{ $favkitap->kitaplar->kategoriler->adi }}</td>
                    <td class="align-middle">{{ $favkitap->kitaplar->adi }}</td>
                    <td class="align-middle">{{ $favkitap->kitaplar->yazarlar->adi_soyadi }}</td>
                    <td class="align-middle">{{ $favkitap->kitaplar->yayin_evleri->adi }}</td>
                    <td class="align-middle">{{ $favkitap->kitaplar->sayfa_sayisi }}</td>
                    <td class="align-middle">{{ $favkitap->kitaplar->yayin_yili }}</td>
                    <td class="align-middle"><a class="text-decoration-none"
                                                href="{{ route('sellers', $favkitap->kitaplar->saticilar->id) }}">{{ $favkitap->kitaplar->saticilar->firma_adi }}</a>
                    </td>
                    <td class="align-middle">{{ '₺ '. $favkitap->kitaplar->fiyat }}</td>
                    <td class="align-middle">
                        <button type="submit" class="btn-favorilerden-cikar btn bg-warning" style="font-size: 18px"
                                data-selected-value="{{ $favkitap->kitaplar->id ?? null }}">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            let $fav = $('.btn-favorilerden-cikar');

            $fav.click(function () {
                let favButton = $(this).data('selected-value');
                let urlSil = '{{ route('books.deleteFavorite', ['kitap' => "#kitapID"]) }}'.replace('#kitapID', favButton);

                $.ajax({
                    url: urlSil,
                    method: "DELETE",
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    success: function (data) {
                        if (data.status) {
                            window.location.reload();
                        }
                    },
                    error: function (xhr) {
                        console.log('E => ', xhr)
                    }
                });
            });
        });
    </script>
@endsection