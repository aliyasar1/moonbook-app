@extends('layouts.kullanicilar.master')

@section('title')
    <title>MoonBook | Ödeme Hatalı</title>
@endsection

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-center align-items-center">
            <img style="width: 200px" src="{{ \Illuminate\Support\Facades\Storage::url('public/basarisiz.png') }}"
                 alt="Ödeme Başarısız">
        </div>
        <div class="alert alert-danger text-center mt-3" role="alert" style="font-size: 20px">
            {{ $errorMessage }}! Ödeme işlemlerinizi kontrol edip tekrar deneyiniz.
        </div>
        <div class="d-flex justify-content-center align-items-center my-3">
            <a role="button" href="{{ route('kitaplar.sepet') }}" class="btn btn-warning" style="font-size: 20px">
                <i class="fa-solid fa-cart-shopping" style="color: black;"></i>
                <b>Sepetim</b>
            </a>
        </div>
    </div>
@endsection