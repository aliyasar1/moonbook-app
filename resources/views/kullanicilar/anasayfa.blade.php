@extends('layouts.kullanicilar.master')

@section('hero')
    <header class=" py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-black text-center mb-2">MoonBook</h1>
                        <h3 class="text-black text-center mb-2">Al, Oku, Yaşa</h3>
                        <p class="lead fw-normal text-center text-black mb-4">İnsan ancak kitap okuyarak dünyaya
                            daha farklı bir pencereden bakabilir. Kitaplar sayesinde hayal dünyamızı daha da
                            geliştirir.
                            Kendimizi başka insanların
                            yerine koyarak empati kurma becerisine sahip oluruz. Söz dağarcığımız gelişir . Konuşma
                            ve
                            dinleme yeteneğimiz gelişir.</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a class="btn btn-dark text-warning btn-lg px-4 me-sm-3" href="{{ route('kitaplar.kitaplar') }}">Kitaplar</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5"
                                                                                   src="{{ asset('storage/bookimage.png') }}"
                                                                                   alt="..."/></div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <!-- Features section-->
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">Sizin İçin Seçilmiş Kategoriler</h2></div>
                <div class="col-lg-8">
                    <div class="row gx-5 row-cols-1 row-cols-md-2">
                        <div class="col mb-5 px-1 h-100">
                            <div class="bd-example">
                                <div class="carousel-inner">
                                    <div class="row">
                                        @foreach($kitapRoman as $kitap)
                                            <img src="{{ asset('storage/saticilar/kitaplar/'. $kitap->fotograf) }}"
                                                 class="d-block w-25 h-25" alt="...">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="feature text-white rounded-3 mb-1"><span
                                        class="badge text-bg-warning">Roman</span></div>
                            <p class="mb-0"> @foreach($kitapRoman as $kitap)
                                    {{ $kitap->adi. ', ' }}
                                @endforeach</p>
                        </div>

                        <div class="col mb-5 px-1 h-100">
                            <div class="bd-example">
                                <div class="carousel-inner">
                                    <div class="row">
                                        @foreach($kitapKG as $kitap)
                                            <img src="{{ asset('storage/saticilar/kitaplar/'. $kitap->fotograf) }}"
                                                 class="d-block w-25 h-25 mb-2" alt="...">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="feature text-white rounded-3 mb-1"><span
                                        class="badge text-bg-warning">Kişisel Gelişim</span></div>
                            <p class="mb-0"> @foreach($kitapKG as $kitap)
                                    {{ $kitap->adi. ', ' }}
                                @endforeach</p>
                        </div>


                        <div class="col mb-5 px-1 h-100">
                            <div class="bd-example">
                                <div class="carousel-inner">
                                    <div class="row">
                                        @foreach($kitapCR as $kitap)
                                            <img src="{{ asset('storage/saticilar/kitaplar/'. $kitap->fotograf) }}"
                                                 class="d-block w-25 h-25 mb-2" alt="...">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="feature text-white rounded-3 mb-1"><span
                                        class="badge text-bg-warning">Çizgi Roman</span></div>
                            <p class="mb-0"> @foreach($kitapCR as $kitap)
                                    {{ $kitap->adi. ', ' }}
                                @endforeach</p>
                        </div>

                        <div class="col mb-5 px-1 h-100">
                            <div class="bd-example">
                                <div class="carousel-inner">
                                    <div class="row">
                                        @foreach($kitapAT as $kitap)
                                            <img src="{{ asset('storage/saticilar/kitaplar/'. $kitap->fotograf) }}"
                                                 class="d-block w-25 h-25 mb-2" alt="...">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="feature text-white rounded-3 mb-1"><span
                                        class="badge text-bg-warning">Araştırma - Tarih</span></div>
                            <p class="mb-0"> @foreach($kitapAT as $kitap)
                                    {{ $kitap->adi. ', ' }}
                                @endforeach</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonial section-->
    <div class="py-5 bg-light">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-10 col-xl-7">
                    <div class="text-center">
                        <div class="fs-4 mb-4 fst-italic">"Kitaplar kendinize ve başkalarına saygı duymayı öğretecek,
                            yüreği ve aklı, dünya ve insanlık sevgisiyle dolduracaktır."
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <img class="rounded-circle me-3" src="{{ asset('storage/maksimgorki.jpg') }}" alt="..."/>
                            <div class="fw-bold">
                                Maksim Gorki
                                <span class="fw-bold text-warning mx-1">/</span>
                                Yazar
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog preview section-->
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">Son Yorumlar</h2>
                        <p class="lead fw-normal text-muted mb-5">İstediğiniz kitabı almadan önce, kitap hakkında
                            yapılan yorumları okuyarak fikir sahibi olabilirsiniz.</p>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                @foreach($anasayfaYorumlar as $anasayfaYorum)
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <div class="d-flex justify-content-center my-3">
                                <div class="ratio-3x2 mb-3" style="width: 150px; height: 200px;">
                                    <img class="card-img-top shadow-sm"
                                         src="{{ asset('storage/saticilar/kitaplar/'. $anasayfaYorum->kitaplar->fotograf) }}"
                                         alt="..."/>
                                </div>
                            </div>
                            <div class="card-body p-4 mt-2">
                                <div class="badge bg-warning bg-gradient text-dark rounded-pill mb-2">Yorum</div>
                                <span class="stars mx-2">
                                @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $anasayfaYorum->puan)
                                            <i class="star1 fa-solid fa-star" style="font-size: 14px;"></i>
                                        @else
                                            <i class="star1 fa-regular fa-star" style="font-size: 14px;"></i>
                                        @endif
                                    @endfor
                                </span>
                                <a class="text-decoration-none link-dark stretched-link"
                                   href="{{ route('kitaplar.kitap_detayi', $anasayfaYorum->kitaplar->id) }}"><h5
                                            class="card-title mb-3">{{ $anasayfaYorum->kitaplar->adi }}</h5></a>
                                <p class="card-text mb-0">{{ $anasayfaYorum->yorum }}</p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3" style="width: 40px; height: 40px"
                                             src="{{ asset('storage/musteriler/'. $anasayfaYorum->kullanicilar->fotograf) }}"
                                             alt="..."/>
                                        <div class="small">
                                            <div class="fw-bold">{{ $anasayfaYorum->kullanicilar->adi_soyadi }}</div>
                                            <div class="text-muted">{{ \Illuminate\Support\Carbon::parse($anasayfaYorum->created_at)->format('d M Y') . ' - ' . $anasayfaYorum->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
