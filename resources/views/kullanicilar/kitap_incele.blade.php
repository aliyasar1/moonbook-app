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
                        <p class="d-inline"><b>Yazar: </b> {{ $kitap->yazarlar->adi_soyadi }}</p>
                        <p class="d-inline"><b>Yayınevi: </b> {{ $kitap->yayin_evleri->adi }}</p>
                        <p class="d-inline"><b>Sayfa Sayısı: </b> {{ $kitap->sayfa_sayisi }} sayfa</p>
                        <p class="d-inline"><b>Yayın Yılı: </b> {{ $kitap->yayin_yili }}</p>
                        <p class="d-inline"><b>Stok Durumu: </b> {{ $kitap->stok->stok_adeti }} adet</p>
                    </div>
                    <div class="flex-fill d-flex gap-3 mt-5 mb-0 align-items-center">
                        <label for="exampleFormControlSelect1" style="font-size: 18px;">Adet :</label>
                        <select class="form-control" style="font-size: 18px; width: 10%" id="exampleFormControlSelect1">
                            @for($adet = 1; $adet<=$kitapadeti; $adet++)
                                <option value="{{ $adet }}">{{ $adet }}</option>
                                @break($adet == 10)
                            @endfor
                        </select>
                        <button class="btn bg-warning" style="font-size: 18px"><i class="fa-solid fa-cart-shopping"></i><b>
                                Sepete Ekle</b>
                        </button>
                        <button class="btn bg-warning" style="font-size: 18px"><i class="fa-solid fa-heart"></i><b>
                                Favorilere Ekle</b>
                        </button>
                    </div>
                </div>
            </div>
            <p class="my-3"><b>Açıklama: </b> {{ $kitap->aciklama }}</p>
            <div class="d-block justify-content-center">
                <label for="yorum" class="px-0" style="font-size: 24px">Yorum Ekle</label>
                <span class="stars mx-2">
                    <i class="star1 fa-regular fa-star" title="1"></i>
                    <i class="star2 fa-regular fa-star" title="2"></i>
                    <i class="star3 fa-regular fa-star" title="3"></i>
                    <i class="star4 fa-regular fa-star" title="4"></i>
                    <i class="star5 fa-regular fa-star" title="5"></i>
                    <span class="average"></span>
                </span>
                <textarea name="yorum" class="form-control" style="resize: none;" id="yorum" cols="30" rows="5"
                          placeholder="Yorum..."></textarea>
                <button class="btn bg-warning mt-2" style="width: 10%;">
                    <i class="fa-solid fa-comment"></i><b> Yorum Ekle</b></button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(".star1").click(function () {
                $(".star1").removeClass("fa-regular").addClass("fa-solid");
                $(".star2,.star3,.star4,.star5").removeClass("fa-solid").addClass("fa-regular");
                $(".average").text("1 puan verdiniz...")
            });

            $(".star2").click(function () {
                $(".star1,.star2").removeClass("fa-regular").addClass("fa-solid");
                $(".star3,.star4,.star5").removeClass("fa-solid").addClass("fa-regular");
                $(".average").text("2 puan verdiniz...")
            });

            $(".star3").click(function () {
                $(".star1,.star2,.star3").removeClass("fa-regular").addClass("fa-solid");
                $(".star4,.star5").removeClass("fa-solid").addClass("fa-regular");
                $(".average").text("3 puan verdiniz...")
            });

            $(".star4").click(function () {
                $(".star1,.star2,.star3,.star4").removeClass("fa-regular").addClass("fa-solid");
                $(".star5").removeClass("fa-solid").addClass("fa-regular");
                $(".average").text("4 puan verdiniz...")
            });

            $(".star5").click(function () {
                $(".star1,.star2,.star3,.star4,.star5").removeClass("fa-regular").addClass("fa-solid");
                $(".average").text("5 puan verdiniz...")
            });
        });
    </script>
@endsection
