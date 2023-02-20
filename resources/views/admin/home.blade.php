@extends('layouts.admin.master')
@section('title')
    <title>MoonBook | Anasayfa</title>
@endsection
@section('content')
    <div class="row mx-3 flex-fill">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="d-flex justify-content-start gap-3 align-items-center">
                <div class="card mb-4 py-3 border-left-danger" style="width: 350px">
                    <div class="card-body" style="font-size: 22px">
                        Toplam Kitap Adeti: {{ $bookQuantity }} Adet
                    </div>
                </div>
                <div class="card mb-4 py-3 border-left-danger" style="width: 350px">
                    <div class="card-body" style="font-size: 22px">
                        Favorideki Kitap Adeti: {{ $favoriteBookQuantity }} Adet
                    </div>
                </div>
                <div class="card mb-4 py-3 border-left-danger" style="width: 350px">
                    <div class="card-body" style="font-size: 22px">
                        Beklenen Siparişler:  Adet
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
