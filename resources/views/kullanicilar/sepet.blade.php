@extends('layouts.kullanicilar.master')

@section('title')
    <title>MoonBook | Sepet</title>
@endsection

@section('content')
    <div class="container my-5 d-flex justify-content-around">
        <div>
            <table class="table shadow-sm" style="border: 1px #f4b122;">
                <thead class="bg-warning text-center">
                <tr>
                    <th scope="col">Kitap ID</th>
                    <th scope="col">Fotoğraf</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Kitap Adı</th>
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
                        <td class="align-middle">{{ '₺ '. $sepetDetay->kitaplar->fiyat }}</td>
                        <td class="align-middle">
                            <div class="sepet-input-group mx-auto">
                                <span class="btn-azalt input-group-text"><i class="fa-solid fa-minus"></i></span>
                                <label for="adet" hidden></label>
                                <input type="text" id="adet" class="form-control text-center bg-white"
                                       style="font-size: 16px" value="{{ $sepetDetay->miktar }}"
                                       data-secilen-kitap="{{ $sepetDetay->kitaplar->id }}" readonly>
                                <span class=" btn-arttir input-group-text"><i class="fa-solid fa-plus"></i></span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <button type="button" class="sepetten-sil btn bg-warning" style="font-size: 18px"
                                    data-selected-value="{{ $sepetDetay->kitaplar->id ?? null }}">
                                <i class="fa-solid fa-trash-can" style="font-size: 20px"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="max-height: 500px">
            <div class="sepet-box" style="max-height: 250px">
                <h3>Sepetim ({{ $sepettekiKitapSayisi }})</h3>
                <hr>
                <div class="d-flex justify-content-between">
                    <p>Kitapların Toplamı :</p>
                    <p>{{ $sepetTutari }} ₺</p>
                </div>
            </div>
            <div class="my-4">
                <button class="btn bg-warning w-100" id="sepetiOnayla"><b style="font-size: 20px">Sepeti Onayla</b>
                </button>
            </div>
        </div>
    </div>
    <div class="container my-5 w-25" id="kartBilgileri" hidden>
        <h1 class="h3 mb-3 fw-normal">Kredi Kartı Bilgileri</h1>

        <div class="form-group mt-2">
            <input label="Ad Soyad" class="form-control" placeholder="Kart üzerindeki ad soyad" field="name"/>
        </div>

        <div class="form-group mt-2">
            <input label="Kart No" class="form-control" placeholder="16 haneli kart numaranızı giriniz"
                   field="card_no"/>
        </div>

        <div class="form-group mt-2">
            <input label="Son Kullanım Ay" class="form-control" placeholder="Son kullanım ay giriniz"
                   field="expire_month"
                   type="number"/>
        </div>

        <div class="form-group mt-2">
            <input label="Son Kullanım Yılı" class="form-control" placeholder="Son kullanım yılını giriniz"
                   field="expire_year"
                   type="number"/>
        </div>

        <div class="form-group mt-2">
            <input label="Cvc" class="form-control" placeholder="Cvc kodunu giriniz" field="cvc" type="number"/>
        </div>

        <button class="w-100 btn btn-lg btn-warning mt-4" type="submit">Satın Al</button>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            let btnarttir = $('.btn-arttir');
            let btnazalt = $('.btn-azalt');
            let adetInputID = $('#adet');
            let $adet = 1;

            btnarttir.click(function () {

                if ($adet < 10) {
                    $adet++;
                    adetInputID.val($adet);
                    adetInputID.attr('value', $adet);
                } else if ($adet >= 10) {
                    adetInputID.val(10);
                    adetInputID.attr('value', 10);
                }
            });

            btnazalt.click(function () {

                if ($adet > 1) {
                    $adet--;
                    adetInputID.val($adet);
                    adetInputID.attr('value', $adet);
                } else if ($adet <= 1) {
                    adetInputID.val(1);
                    adetInputID.attr('value', 1);
                }
            });

            let btnSepetiOnayla = $('#sepetiOnayla');
            btnSepetiOnayla.click(function () {
                $('#kartBilgileri').removeAttr('hidden');
            });

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