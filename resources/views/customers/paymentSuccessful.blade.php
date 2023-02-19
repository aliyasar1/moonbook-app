@extends('layouts.customers.master')

@section('title')
    <title>MoonBook | Ödeme Alındı</title>
@endsection

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-center align-items-center">
            <img style="width: 200px" src="{{ \Illuminate\Support\Facades\Storage::url('public/basarili.png') }}"
                 alt="Ödeme Başarılı">
        </div>
        <div class="alert alert-success text-center mt-3" role="alert" style="font-size: 20px">
            Ödeme Başarılı! <b>{{ $sepet->kod }}</b> fatura numaralı siparişinizi takip edebilirsiniz.
        </div>
        <div class="d-flex justify-content-center align-items-center my-3">
            <a role="button" href="{{ route('home') }}" class="btn btn-warning" style="font-size: 20px">
                <i class="fa-solid fa-home" style="color: black;"></i>
                <b>Anasayfa</b>
            </a>
        </div>
    </div>
@endsection