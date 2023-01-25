@extends('layouts.kullanicilar.master')

@section('title')
    <title>Moonbook | {{ $kitap->adi }}</title>
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
                                style="width: 100%; height: 100%; object-fit: cover;  @if($kitapadeti == 0) filter: grayscale(100%) @endif"
                                src="{{ \Illuminate\Support\Facades\Storage::url('public/saticilar/kitaplar/'. $kitap->fotograf) }}"
                                alt="Varsayılan Fotoğraf"
                                class="preview-image">
                        @if($kitapadeti==0)
                            <span class="badge bg-danger mt-3 position-absolute shadow-lg"
                                  style="font-size: 30px; transform: rotate(35deg)">Tükendi</span>
                        @endif

                    </div>
                </div>
                <div class="mx-4 d-block justify-content-around" style="flex: 2;">
                    <h2>{{ $kitap->adi }}</h2>
                    <hr>
                    <div class="d-flex justify-content-lg-between">
                        <p class="d-inline"><b>Yazar: </b><a class="text-decoration-none"
                                                             href="{{ route('yazar_kitaplari', $kitap->yazarlar->id) }}">{{ $kitap->yazarlar->adi_soyadi }}</a>
                        </p>
                        <p class="d-inline"><b>Yayınevi: </b> <a
                                    href="{{ route('yayin_evleri_kitaplari', $kitap->yayin_evleri->id) }}"
                                    class="text-decoration-none">{{ $kitap->yayin_evleri->adi }}</a></p>
                        <p class="d-inline"><b>Sayfa Sayısı: </b> {{ $kitap->sayfa_sayisi }} sayfa</p>
                        <p class="d-inline"><b>Yayın Yılı: </b> {{ $kitap->yayin_yili }}</p>
                        <p class="d-inline"><b>Stok Durumu: </b> {{ $kitap->stok->stok_adeti }} adet</p>
                    </div>
                    <p><b>Satıcı: </b><a href="{{ route('saticilar', $kitap->saticilar->id) }}"
                                         class="text-decoration-none">{{ $kitap->saticilar->firma_adi }}</a>
                    </p>
                    <form id="form-sepete-ekle">
                        <div class="form-group flex-fill d-flex gap-3 mt-5 mb-0 align-items-center">
                            <label for="adet" style="font-size: 18px;" class="form-label">Adet :</label>
                            <div class="input-group" style="width: 15%; flex-wrap: nowrap">
                                <span class="btn-azalt input-group-text"><i class="fa-solid fa-minus"></i></span>
                                <input type="text" id="adet" name="adet" class="form-control text-center bg-white"
                                       style="font-size: 16px"
                                       value="1" readonly>
                                <span class="btn-arttir input-group-text"><i class="fa-solid fa-plus"></i></span>
                            </div>
                            <button type="button" class="sepete-ekle btn bg-warning" style="font-size: 18px"
                                    data-selected-value="{{ $kitap->id }}"><i class="fa-solid fa-cart-shopping"></i>
                                <b class="mx-2">Sepete Ekle</b>
                            </button>
                            <button type="button" class="btn bg-warning" style="font-size: 18px"
                                    id="btn-favorilere-ekle">
                                <i class="@isset($favoriKitaplar) @foreach($favoriKitaplar as $favkitap) @if($kitap->id === $favkitap->kitap_id) fa-solid @break @else fa-regular @endif @endforeach fa-regular @endisset fa-heart"></i>
                                <b class="mx-2">Favorilere Ekle</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <p class="my-3"><b>Açıklama: </b> {{ $kitap->aciklama }}</p>
            <form method="post" action="{{ route('kitaplar.yorum_ekle', $kitap->id) }}">
                @csrf
                <input type="hidden" id="starInput" name="puan" value="1">
                <div class="d-block justify-content-center">
                    <label for="yorum" class="px-0" style="font-size: 24px">Yorum Ekle</label>
                    <span class="stars mx-2" id="stars">
                    <i class="star1 fa-regular fa-star" title="1" data-selected-value="1"></i>
                    <i class="star2 fa-regular fa-star" title="2" data-selected-value="2"></i>
                    <i class="star3 fa-regular fa-star" title="3" data-selected-value="3"></i>
                    <i class="star4 fa-regular fa-star" title="4" data-selected-value="4"></i>
                    <i class="star5 fa-regular fa-star" title="5" data-selected-value="5"></i>
                        <small>( {{ number_format($puanOrt,2,'.') }} )</small>
                    <span class="average"></span>
                </span>
                    <textarea name="yorum" class="form-control" style="resize: none;" id="yorum" cols="30" rows="5"
                              placeholder="Yorum..."></textarea>
                    <button type="submit" class="btn bg-warning mt-2" style="width: 10%;">
                        <i class="fa-solid fa-comment"></i><b> Yorum Ekle</b></button>
                </div>
            </form>
        </div>
        <h2 class="my-3 mt-5">Yorumlar</h2>
        <div class="my-3">
            @foreach($yorumlar as $yorum)
                <div class="mb-5">
                    <div class="card shadow border-0" style="height: 150px; width: 100%">
                        <div class="card-body p-4 pb-3">
                            <span class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $yorum->puan)
                                        <i class="star1 fa-solid fa-star" style="font-size: 14px;"></i>
                                    @else
                                        <i class="star1 fa-regular fa-star" style="font-size: 14px;"></i>
                                    @endif
                                @endfor
                            </span>
                            <p class="card-text mt-2">{{ $yorum->yorum }}</p>
                        </div>
                        <div class="card-footer mb-2 p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" style="width: 40px; height: 40px"
                                         src="{{ asset('storage/musteriler/'. $yorum->kullanicilar->fotograf) }}"
                                         alt="..."/>
                                    <div class="small">
                                        <div class="fw-bold">{{ $yorum->kullanicilar->adi_soyadi }}</div>
                                        <div class="text-muted">{{ \Illuminate\Support\Carbon::parse($yorum->created_at)->format('d M Y') . ' - ' . $yorum->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
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
        let starPoint = 0;

        $(document).ready(function () {
            let btnarttir = $('.btn-arttir');
            let btnazalt = $('.btn-azalt');
            let adetInput = $('#adet');
            let $adet = 1;

            btnarttir.click(function () {

                if ($adet < 10) {
                    $adet++;
                    adetInput.val($adet);
                    adetInput.attr('value', $adet);
                } else if ($adet >= 10) {
                    adetInput.val(10);
                    adetInput.attr('value', 10);
                }
            });

            btnazalt.click(function () {

                if ($adet > 1) {
                    $adet--;
                    adetInput.val($adet);
                    adetInput.attr('value', $adet);
                } else if ($adet <= 1) {
                    adetInput.val(1);
                    adetInput.attr('value', 1);
                }
            });

            let $stars = $('#stars');
            let $fav = $('#btn-favorilere-ekle');

            if ($fav.find('i').hasClass('fa-solid')) {
                $fav.find('b').text('Favorilerden Çıkar');
            } else if ($fav.find('i').hasClass('fa-regular')) {
                $fav.find('b').text('Favorilere Ekle');
            }

            $stars.find('i').click(function () {
                let star = $(this);
                let starPointData = star.data('selected-value');

                starPoint = starPointData;

                $(".average").text(starPointData + " puan verdiniz...")

                if (star.hasClass('fa-regular')) {
                    star.removeClass("fa-regular").addClass("fa-solid");
                } else if (star.hasClass('fa-solid')) {
                    star.removeClass("fa-solid").addClass("fa-regular");
                }

                $.each($stars.find('i'), function (index, item) {
                    if (index <= star.index()) {
                        $(item).removeClass('fa-regular').addClass('fa-solid');
                    } else if (index > star.index()) {
                        $(item).removeClass('fa-solid').addClass('fa-regular');
                    }
                });

                $("#starInput").val(starPoint);
            });

            let kitapID = '{{ $kitap->id ?? null }}';
            $fav.click(function () {
                let favkitap = $fav.find('i');
                let urlEkle = '{{ route('kitaplar.favorilere_ekle', ['kitap' => "#kitapID"]) }}'.replace('#kitapID', kitapID);
                let urlSil = '{{ route('kitaplar.favorilerden_sil', ['kitap' => "#kitapID"]) }}'.replace('#kitapID', kitapID);

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
                let url = '{{ route('kitaplar.sepete_ekle', ['kitap' => "#kitapID"]) }}'.replace('#kitapID', sepeteEklenecekKitapID);
                $.ajax({
                    url: url,
                    method: "POST",
                    data: $('#form-sepete-ekle').serializeArray(),
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
