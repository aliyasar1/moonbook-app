@extends('layouts.customers.master')

@section('title')
    <title>MoonBook | Kitaplar</title>
@endsection
@section('content')
    <div class="container my-5">
        <ul class="nav gap-3 d-flex justify-content-center my-3 ">
            @foreach($kategoriler as $kategori)
                <li class="nav-item">
                    <a class="btn bg-warning"
                       href="{{ route('books.category', ['kategori' => $kategori->id]) }}"><b>{{ $kategori->adi }}</b></a>
                </li>
            @endforeach
        </ul>
        <div class="gap-3 g-col-4 d-flex flex-wrap"
             style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            @foreach($kitaplar as $kitap)
                <div class="max-w-12xl sm:px-6 lg:px-8" style="margin-right: 5px">
                    <div class="card" style="width: 15rem; align-items: center; padding: 1.25rem;">
                        <div class="fvrt-btn bg-warning d-flex justify-content-center align-items-center">
                            <i class="@isset($favoriKitaplar) @foreach($favoriKitaplar as $favkitap) @if($kitap->id === $favkitap->kitap_id) fa-solid @break @else fa-regular @endif @endforeach fa-regular @endisset fa-heart"
                               style="font-size: 18px" data-selected-value="{{ $kitap->id }}"></i>
                        </div>
                        <div class="ratio-3x2 mb-3" style="width: 150px; height: 200px;">
                            <img class="w-100 h-100 shadow-sm"
                                 src="{{ asset('storage/saticilar/kitaplar/'. $kitap->fotograf ) }}"
                                 alt="Card image cap">
                        </div>

                        <div class="card-body p-0 w-100 text-truncate">
                            <p class="card-text mb-3" style="color: black">
                                <span class="badge text-decoration-none text-bg-warning"
                                      href="#">{{ $kitap->kategoriler->adi }}</span>
                                @if($kitap->stok->stok_adeti === 0)
                                    <span class="badge badge-pill bg-danger">Tükendi</span>
                                @endif
                            </p>

                            <h4 class="kitap-adi card-title mb-0"
                                style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                title="{{ $kitap->adi }}" data-value="{{ $kitap->adi }}">{{ $kitap->adi }}</h4>

                            <p class="card-text mb-2"
                               style="font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                               title="{{ $kitap->yazarlar->adi_soyadi }}">
                                <a class="text-decoration-none"
                                   href="{{ route('writerBooks', $kitap->yazarlar->id) }}">{{ $kitap->yazarlar->adi_soyadi }}</a>

                                <span title="{{$kitap->yayin_evleri->adi }}">
                                    <a href="{{ route('publishingHousesBooks', $kitap->yayin_evleri->id) }}"
                                       class="text-decoration-none">{{ ' - '. $kitap->yayin_evleri->adi }}</a>
                                </span>
                            </p>

                            <p class="card-text mb-1" style="font-size: 24px;"><b>{{'₺'. $kitap->fiyat }}</b></p>

                            <div class="feature text-white rounded-3 mb-1">
                                <p class="card-text mb-3" style="color: black">
                                    Satıcı : <a class="text-decoration-none"
                                                href="{{ route('sellers', $kitap->saticilar->id) }}">{{ $kitap->saticilar->firma_adi }}</a>
                                </p>
                            </div>

                            <div class="flex-fill d-flex gap-3 mb-0 justify-content-center">
                                <a href="{{ route('books.bookDetail', $kitap->id) }}"
                                   class="btn btn-warning w-50"><b>İncele</b></a>

                                <button class="sepete-ekle btn btn-warning w-50"
                                        @if($kitap->stok->stok_adeti === 0) disabled
                                        @endif data-selected-value="{{ $kitap->id }}">
                                    <b>Sepete Ekle</b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

            let $fav = $('.fvrt-btn');

            $fav.find('i').click(function () {
                let favkitap = $(this);
                let favkitapID = favkitap.data('selected-value');
                let urlEkle = '{{ route('books.addFavorites', ['kitap' => "#kitapID"]) }}'.replace('#kitapID', favkitapID);
                let urlSil = '{{ route('books.deleteFavorite', ['kitap' => "#kitapID"]) }}'.replace('#kitapID', favkitapID);

                if (favkitap.hasClass('fa-solid')) {
                    favkitap.removeClass("fa-solid").addClass("fa-regular");
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
                } else if (favkitap.hasClass('fa-regular')) {
                    favkitap.removeClass("fa-regular").addClass("fa-solid");

                    $.ajax({
                        url: urlEkle,
                        method: "POST",
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
                }
            });

            let $sepeteEkle = $('.sepete-ekle');

            $sepeteEkle.click(function () {
                let sepeteEklenecekKitapID = $(this).data('selected-value');
                let url = '{{ route('books.addToCart', ['kitap' => "#kitapID"]) }}'.replace('#kitapID', sepeteEklenecekKitapID);

                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    success: function (data) {
                        if (data.status) {
                            $.notify('Sepete Eklendi.', 'success');
                            setTimeout(function () {
                                window.location.reload()
                            }, 2000);
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