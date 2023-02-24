@extends('layouts.admin.master')
@section('title')
    <title>MoonBook | Anasayfa</title>
@endsection
@section('content')
    <div class="row mx-3 flex-fill">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="d-flex justify-content-start gap-3 align-items-center">
                <a class="text-decoration-none" style="color: #8d8796;" href="{{ route('seller.books.home') }}">
                    <div class="card mb-4 py-3 border-left-danger" style="width: 350px">
                        <div class="card-body" style="font-size: 22px">
                            Toplam Kitap Adeti: {{ $bookQuantity }} Adet
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" style="color: #8d8796;" href="{{ route('seller.books.favorites') }}">
                    <div class="card mb-4 py-3 border-left-danger" style="width: 350px">
                        <div class="card-body" style="font-size: 22px">
                            Favorideki Kitap Adeti: {{ $favoriteBookQuantity }} Adet
                        </div>
                    </div>
                </a>
                <div class="card mb-4 py-3 border-left-danger" style="width: 350px">
                    <div class="card-body" style="font-size: 22px">
                        Beklenen Siparişler:  Adet
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
