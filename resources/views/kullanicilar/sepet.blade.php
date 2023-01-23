@extends('layouts.kullanicilar.master')

@section('title')
    <title>MoonBook | Sepet</title>
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
                <th scope="col">Fiyat</th>
                <th scope="col">Adet</th>
                <th scope="col">Sepet</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sepet_detaylari as $sepetDetay)
                <tr class="text-center">
                    <td class="align-middle">{{ $sepetDetay->kitaplar->id }}</td>
                    <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="ratio3x2" style="width: 70px"
                             src="{{ Storage::url('public/saticilar/kitaplar/'. $sepetDetay->kitaplar->fotograf )}}"
                             alt="{{ $sepetDetay->kitaplar->adi }}"></td>
                    <td class="align-middle">{{ $sepetDetay->kitaplar->kategoriler->adi }}</td>
                    <td class="align-middle">{{ $sepetDetay->kitaplar->adi }}</td>
                    <td class="align-middle">{{ $sepetDetay->kitaplar->yazarlar->adi_soyadi }}</td>
                    <td class="align-middle">{{ $sepetDetay->kitaplar->yayin_evleri->adi }}</td>
                    <td class="align-middle">{{ $sepetDetay->kitaplar->sayfa_sayisi }}</td>
                    <td class="align-middle">{{ $sepetDetay->kitaplar->yayin_yili }}</td>
                    <td class="align-middle">{{ '₺ '. $sepetDetay->kitaplar->fiyat }}</td>
                    <td class="align-middle">{{ $sepetDetay->miktar }}</td>
                    <td class="align-middle">
                        <button type="button" class="sepetten-sil btn bg-warning" style="font-size: 18px"
                                data-selected-value="{{ $sepetDetay->kitaplar->id ?? null }}">
                            <i class="fa-regular fa-circle-xmark" style="font-size: 20px"></i><b class="mx-2">Çıkar</b>
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

            let $sepettenSil = $('.sepetten-sil');

            $sepettenSil.click(function () {
                let sepettenSilinecekKitapID = $(this).data('selected-value');
                let url = '{{ route('kitaplar.sepetten_sil', ['sepet' => "#sepetID", 'kitap' => '#kitapID']) }}'.replace('#sepetID', '{{ $sepet->id }}').replace('#kitapID', sepettenSilinecekKitapID);

                $.ajax({
                    url: url,
                    method: "GET",
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