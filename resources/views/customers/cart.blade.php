@php use App\Models\CartDetails; @endphp
@extends('layouts.customers.master')

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
                @foreach($cartDetails as $detail)
                    <tr class="text-center">
                        <td class="align-middle">{{ $detail->kitaplar->id }}</td>

                        <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="ratio3x2" style="width: 70px"
                                 src="{{ Storage::url('public/saticilar/kitaplar/'. $detail->kitaplar->fotograf )}}"
                                 alt="{{ $detail->kitaplar->adi }}">
                        </td>

                        <td class="align-middle">{{ $detail->kitaplar->kategoriler->adi }}</td>

                        <td class="align-middle">{{ $detail->kitaplar->adi }}</td>

                        <td class="align-middle price" data-price="{{ $detail->kitaplar->fiyat }}">₺ {{ $detail->kitaplar->fiyat }}</td>

                        <td class="align-middle">
                            <form class="form-sepet-guncelle">
                                <div class="sepet-input-group mx-auto">
                                    <span class="btn-azalt input-group-text" data-cart_detail_id="{{ $detail->id }}"><i class="fa-solid fa-minus"></i></span>

                                    <label for="adet" hidden></label>
                                    <input type="text" id="adet" class="form-control text-center bg-white adet"
                                           style="font-size: 16px" value="{{ $detail->miktar }}"
                                           data-secilen-kitap="{{ $detail->kitaplar->id }}" readonly>

                                    <span class="btn-arttir input-group-text" data-cart_detail_id="{{ $detail->id }}"><i class="fa-solid fa-plus"></i></span>
                                </div>
                            </form>
                        </td>

                        <td class="align-middle">
                            <button type="button" class="sepetten-sil btn bg-warning" style="font-size: 18px"
                                    data-selected-value="{{ $detail->kitaplar->id ?? null }}">
                                <i class="fa-solid fa-trash-can" style="font-size: 20px"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div style="max-height: 500px">
            <div class="sepet-box">
                <h3>Sepetim ({{ CartDetails::getSepettekiKitapSayisi() }})</h3>
                <hr>
                <div class="flex-column">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <p>Kitapların Toplamı : </p>
                        <p>{{ $cartSum -= $shippingPrice }} ₺</p>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-between">
                        <p>KDV : </p>
                        <p>{{ $kdv }} ₺</p>
                    </div>
{{--                    <div class="col-lg-12 d-flex justify-content-between">--}}
{{--                        <p>Kargo Bedeli : </p>--}}
{{--                        <p>{{ $shippingPrice }} ₺</p>--}}
{{--                    </div>--}}
                    <hr>
                    <div class="col-lg-12 d-flex justify-content-between">
                        <p>Toplam : </p>
                        <p>{{ $cartSum }} ₺</p>
                    </div>
                </div>
            </div>
            <div class="my-4">
                <button class="btn bg-warning w-100" id="sepetiOnayla"><b style="font-size: 20px">Sepeti Onayla</b>
                </button>
            </div>
            <form method="post" action="{{ route('books.order') }}">
                @csrf
                <div class="sepet-box my-3" id="kartBilgileri" hidden>
                    <h1 class="h3 mb-3 fw-normal">Kredi Kartı Bilgileri</h1>

                    <div class="form-group mt-2">
                        <input label="Ad Soyad" name="adi_soyadi" class="form-control bg-white" placeholder="Ad Soyad"/>
                    </div>

                    <div class="form-group mt-2">
                        <input label="Kart No" name="kart_no" class="form-control bg-white"
                               placeholder="Kart Numarası"/>
                    </div>

                    <div class="form-group mt-2">
                        <div class="d-flex justify-content-between">
                            <input label="Son Kullanım Ay" name="sk_ay" class="form-control bg-white me-1"
                                   placeholder="Ay" type="number"/>
                            <input label="Son Kullanım Yılı" name="sk_yil" class="form-control bg-white me-1"
                                   placeholder="Yıl" type="number"/>
                            <input label="Cvc" class="form-control bg-white" placeholder="CVC" name="cvc"
                                   type="number"/>
                        </div>
                    </div>

                    <button class="w-100 btn btn-lg btn-warning mt-4" type="submit">Satın Al</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function quantityUpdateCartDetail(input, adet, fiyat) {

            let $detailID = $(input).data('cart_detail_id');
            let url = '{{ route('books.quantityOfBookInCart', ['cartDetail' => 'detailID']) }}'.replace('detailID', $detailID);

            fiyat *= adet;

            $.ajax({
                url: url,
                method: "PUT",
                dataType: "JSON",
                data: {
                    miktar: adet,
                    fiyat: fiyat
                },
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
        }

        $(document).ready(function () {

            // Arttır
            $('.btn-arttir').click(function () {
                let input = $(this).closest('.sepet-input-group').find('.adet');
                let bookPrice = $(this).closest('td').closest('tr').find('.price').data('price');
                let adet = input.val();

                adet++;

                if (adet <= 10) {
                    input.val(adet);
                    input.attr('value', adet);
                }

                quantityUpdateCartDetail($(this), adet, bookPrice);

            });

            // Azalt
            $('.btn-azalt').click(function () {
                let input = $(this).closest('.sepet-input-group').find('.adet');
                let bookPrice = $(this).closest('td').closest('tr').find('.price').data('price');
                let adet = input.val();

                adet--;

                if (adet > 0) {
                    input.val(adet);
                    input.attr('value', adet);
                }

                quantityUpdateCartDetail($(this), adet, bookPrice);

            });

            // Sepeti Onayla
            $('#sepetiOnayla').click(function () {
                $('#kartBilgileri').removeAttr('hidden');
            });

            // Sepetten Sil
            let $sepettenSil = $('.sepetten-sil');
            $sepettenSil.click(function () {
                let sepettenSilinecekKitapID = $(this).data('selected-value');
                let url = '{{ route('books.deleteFromCart', ['cart' => "#sepetID", 'book' => '#kitapID']) }}'.replace('#sepetID', '{{ $cart->id }}').replace('#kitapID', sepettenSilinecekKitapID);

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