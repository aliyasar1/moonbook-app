@php
    use App\Models\Favorites;use App\Models\CartDetails;
    use Illuminate\Support\Facades\Auth;
@endphp
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content=""/>

    @yield('title')
    <title>MoonBook | Anasayfa</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('link')

    <!-- Bootstrap icons-->
    <script src="https://kit.fontawesome.com/68b01077e6.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"
            integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column h-100 min-vh-100">
<main class="flex-shrink-0">
    <div class="bg-custom">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg">
            <div class="container px-3">
                <a class="navbar-brand text-black" href="{{ route('home') }}"><img
                            src="{{ asset('storage/logolar/moonbookSiyah.png') }}"
                            width="70px"
                            height="70px" alt="moonbook">MoonBook</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
                </button>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Ara" aria-label="Ara">
                    <button class="btn btn-dark text-warning" type="submit"><i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="font-size: 16px;">
                        <li class="nav-item nav-li"><a class="nav-link text-black"
                                                       href="{{ route('home') }}"><b>Anasayfa</b></a></li>
                        <li class="nav-item nav-li"><a class="nav-link text-black"
                                                       href="{{ route('books.books') }}"><b>Kitaplar</b></a></li>
                        <li class="nav-item nav-li"><a class="nav-link text-black"
                                                       href="{{ route('writers') }}"><b>Yazarlar</b></a></li>
                        <li class="nav-item nav-li">
                            <a class="nav-link text-black" href="{{ route('publishingHouses') }}">
                                <b>Yayın Evleri</b>
                            </a>
                        </li>
                        <li class="nav-item nav-li">
                            <a class="nav-link position-relative" role="button" href="{{ route('books.cart') }}">
                                <i class="fa-solid fa-cart-shopping" style="color: black; font-size: 24px"></i>
                                <span class="position-absolute top-5 start-95 translate-middle badge rounded-pill bg-danger"
                                      style="font-size: 0.65rem;">{{ CartDetails::getSepettekiKitapSayisi() }}</span>
                            </a>
                        </li>
                        <li class="nav-item nav-li">
                            <a class="nav-link position-relative" role="button" href="{{ route('favorites') }}">
                                <i class="fa-solid fa-heart" style="color: black; font-size: 24px"></i>
                                <span class="position-absolute top-5 start-95 translate-middle badge rounded-pill bg-danger"
                                      style="font-size: 0.65rem;">{{ Favorites::getFavoriKitapSayisi() }}</span>
                            </a>
                        </li>
                        <li class="nav-item nav-li dropdown mt-0 pt-0 mx-3"
                            style="border: 2px black solid; border-radius: 5px">
                            <div class="d-flex justify-content-center m-1">
                                <img class="img-profile rounded-circle"
                                     style="width: 40px; height: 40px"
                                     src="{{ Storage::url('public/musteriler/' . Auth::user()->fotograf) }}"
                                     alt="{{ Auth::user()->adi_soyadi }}">
                                <a class="nav-link dropdown-toggle text-black" id="navbarDropdownPortfolio" href="#"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-expanded="false"><b>{{ Auth::user()->adi_soyadi }}</b></a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                                    <li><a class="dropdown-item" href="{{ route('editProfile') }}"><i
                                                    class="fa-solid fa-gear" style="font-size: 16px"></i> Profili
                                            Düzenle</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('allOrders') }}"><i
                                                    class="fa-solid fa-box" style="font-size: 16px"></i> Tüm
                                            Siparişlerim</a>
                                    </li>
                                    <hr>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 16px"></i>
                                            Çıkış Yap</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('hero')
    </div>
