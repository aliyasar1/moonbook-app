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
                @foreach($sepet_detaylari as $sepetDetay)
                    <tr class="text-center">
                        <td class="align-middle">{{ $sepetDetay->kitaplar->id }}</td>

                        <td class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="ratio3x2" style="width: 70px"
                                 src="{{ Storage::url('public/saticilar/kitaplar/'. $sepetDetay->kitaplar->fotograf )}}"
                                 alt="{{ $sepetDetay->kitaplar->adi }}">
                        </td>

                        <td class="align-middle">{{ $sepetDetay->kitaplar->kategoriler->adi }}</td>

                        <td class="align-middle">{{ $sepetDetay->kitaplar->adi }}</td>

                        <td class="align-middle">{{ '₺ '. $sepetDetay->kitaplar->fiyat }}</td>

                        <td class="align-middle">
                            <form method="POST" class="form-sepet-guncelle">
                                @csrf
                                @method('PUT')
                                <div class="sepet-input-group mx-auto">
                                    <span class="btn-azalt input-group-text"><i class="fa-solid fa-minus"></i></span>

                                    <input type="text" id="adet" class="form-control text-center bg-white adet"
                                           style="font-size: 16px" value="{{ $sepetDetay->miktar }}"
                                           data-secilen-kitap="{{ $sepetDetay->kitaplar->id }}" readonly>

                                    <span class="btn-arttir input-group-text"><i class="fa-solid fa-plus"></i></span>
                                </div>
                            </form>
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
            {{--            <button class="btn-guncelle btn btn-warning ">--}}
            {{--                <b>Güncelle</b>--}}
            {{--            </button>--}}
        </div>

        <div style="max-height: 500px">
            <div class="sepet-box" style="max-height: 250px">
                <h3>Sepetim ({{ CartDetails::getSepettekiKitapSayisi() }})</h3>
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
        $(document).ready(function () {
            // Arttır
            $('.btn-arttir').click(function () {
                let input = $(this).closest('.sepet-input-group').find('.adet');
                let $form = $(this).closest('.sepet-input-group').closest('.form-sepet-guncelle');
                let adet = input.val();

                console.log($form)

                adet++;

                if (adet <= 10) {
                    input.val(adet);
                    input.attr('value', adet);
                    console.log($form.serializeArray());
                }
            });

            // Azalt
            $('.btn-azalt').click(function () {
                let input = $(this).closest('.sepet-input-group').find('.adet');
                let adet = input.val();

                adet--;

                if (adet > 0) {
                    input.val(adet);
                    input.attr('value', adet);
                }
            });

            // Sepeti Güncelle

            {{--let $kitapID = $('.sepet-input-group').find('.adet').data('secilen-kitap');--}}
            {{--$('.btn-guncelle').click(function () {--}}
            {{--    console.log($kitapID);--}}
            {{--    let url = '{{ route('books.quantityOfBookInCart', ['sepetDetaylari' => '#kitapID']) }}'.replace('kitapID', $kitapID);--}}

            {{--    $.ajax({--}}
            {{--        url: url,--}}
            {{--        method: "PUT",--}}
            {{--        dataType: "JSON",--}}
            {{--        headers: {--}}
            {{--            'X-CSRF-TOKEN': "{{csrf_token()}}",--}}
            {{--        },--}}
            {{--        success: function (data) {--}}
            {{--            if (data.status) {--}}
            {{--                window.location.reload();--}}
            {{--            }--}}
            {{--        },--}}
            {{--        error: function (xhr) {--}}
            {{--            console.log('E => ', xhr)--}}
            {{--        }--}}
            {{--    });--}}
            {{--})--}}

            // Sepeti Onayla
            $('#sepetiOnayla').click(function () {
                $('#kartBilgileri').removeAttr('hidden');
            });

            // Sepetten Sil
            let $sepettenSil = $('.sepetten-sil');
            $sepettenSil.click(function () {
                let sepettenSilinecekKitapID = $(this).data('selected-value');
                let url = '{{ route('books.deleteFromCart', ['sepet' => "#sepetID", 'kitap' => '#kitapID']) }}'.replace('#sepetID', '{{ $sepet->id }}').replace('#kitapID', sepettenSilinecekKitapID);

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