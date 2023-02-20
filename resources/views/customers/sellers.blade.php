@extends('layouts.customers.master')

@section('title')
    <title>MoonBook | {{ $seller->firma_adi }}</title>
@endsection

@section('content')
    <div class="container my-5">
        <div class="row d-flex flex-column align-items-center">
            <div class="col-lg-12 d-flex mb-3" style="justify-content: center;">
                <div class="d-flex justify-content-center align-items-center"
                     style="flex: 1; border: 1px solid black;">
                    <div class="ratio-3x2 my-2 mx-2 d-flex justify-content-center align-items-center"
                         style="width: 300px">
                        <img
                                style="width: 100%; height: 100%; object-fit: cover;"
                                src="{{ \Illuminate\Support\Facades\Storage::url('public/saticilar/'. $seller->fotograf) }}"
                                alt="Varsayılan Fotoğraf"
                                class="preview-image">
                    </div>
                </div>
                <div class="mx-4 d-block justify-content-around" style="flex: 2;">
                    <h2>{{ $seller->firma_adi }} <small>({{ $seller->kullanici_adi }})</small></h2>
                    <hr>
                    <div class="d-flex justify-content-lg-between">
                        <p class="d-inline"><b>Yetkili: </b>{{ $seller->adi_soyadi }}</p>
                        <p class="d-inline"><b>Telefon No: </b>{{ $seller->tel_no }}</p>
                        <p class="d-inline"><b>E-posta: </b><a
                                    href="mailto:{{ $seller->email }}">{{ $seller->email }}</a></p>
                    </div>
                    <p><b>Adres: </b>{{ $seller->adres }}</p>
                </div>
            </div>
            <h2 class="mt-3">Kitaplar</h2>
            <hr>
            <div class="gap-3 g-col-4 d-flex flex-wrap"
                 style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                @foreach($books as $book)
                    <div class="max-w-12xl sm:px-6 lg:px-8" style="margin-right: 5px">
                        <div class="card" style="width: 15rem; align-items: center; padding: 1.25rem;">
                            <div class="fvrt-btn bg-warning d-flex justify-content-center align-items-center">
                                <i class="@foreach($favoriteBook as $favBook) @if($book->id === $favBook->kitap_id) fa-solid @break @else fa-regular @endif @endforeach fa-regular fa-heart"
                                   style="font-size: 18px" data-selected-value="{{ $book->id }}"></i></div>
                            <div class="ratio-3x2 mb-3" style="width: 150px; height: 200px;">
                                <img class="w-100 h-100"
                                     src="{{ asset('storage/saticilar/kitaplar/'. $book->fotograf ) }}"
                                     alt="Card image cap">
                            </div>
                            <div class="card-body p-0 w-100 text-truncate">
                                <p class="card-text mb-3" style="color: black">
                                <span class="badge text-decoration-none text-bg-warning"
                                      href="#">{{ $book->kategoriler->adi }}</span>
                                    @if($book->stok->stok_adeti === 0)
                                        <span class="badge badge-pill bg-danger">Tükendi</span>
                                    @endif
                                </p>
                                <h4 class="card-title mb-0"
                                    style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                    title="{{ $book->adi }}">{{ $book->adi }}</h4>
                                <p class="card-text mb-2"
                                   style="font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                   title="{{ $book->yazarlar->adi_soyadi }}"><a class="text-decoration-none"
                                                                                 href="{{ route('writerBooks', $book->yazarlar->id) }}">{{ $book->yazarlar->adi_soyadi }}</a>
                                    <span
                                            title="{{$book->yayin_evleri->adi }}"> <a
                                                href="{{ route('publishingHousesBooks', $book->yayin_evleri->id) }}"
                                                class="text-decoration-none">{{ ' - '. $book->yayin_evleri->adi }}</a> </span>
                                </p>
                                <p class="card-text mb-1"
                                   style="font-size: 24px;"><b>{{'₺'. $book->fiyat }}</b></p>
                                <div class="feature text-white rounded-3 mb-1">
                                    <p class="card-text mb-3" style="color: black">
                                        Satıcı : <a class="text-decoration-none"
                                                    href="{{ route('sellers', $book->saticilar->id) }}">{{ $book->saticilar->firma_adi }}</a>
                                    </p>
                                </div>
                                <div class="flex-fill d-flex gap-3 mb-0 justify-content-center">
                                    <a href="{{ route('books.bookDetail', $book->id) }}"
                                       class="btn btn-warning w-50"><b>İncele</b></a>
                                    <button class="sepete-ekle btn btn-warning w-50"
                                            @if($book->stok->stok_adeti === 0) disabled
                                            @endif data-selected-value="{{ $book->id }}">
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

                    let $sepeteEkle = $('.sepete-ekle');

                    $sepeteEkle.click(function () {
                        let sepeteEklenecekKitapID = $(this).data('selected-value');
                        let url = '{{ route('books.addToCart', ['book' => "#kitapID"]) }}'.replace('#kitapID', sepeteEklenecekKitapID);

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

                    let $fav = $('.fvrt-btn');

                    $fav.find('i').click(function () {
                        let favkitap = $(this);
                        let favkitapID = favkitap.data('selected-value');
                        let urlEkle = '{{ route('books.addFavorites', ['book' => "#kitapID"]) }}'.replace('#kitapID', favkitapID);
                        let urlSil = '{{ route('books.deleteFavorite', ['book' => "#kitapID"]) }}'.replace('#kitapID', favkitapID);

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
                });
            </script>
@endsection