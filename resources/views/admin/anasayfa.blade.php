@extends('layouts.admin.master')
@section('title')
    <title>MoonBook | Anasayfa</title>
@endsection
@section('content')
    <div class="row mx-3 flex-fill">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card mb-4 py-3 border-left-danger" style="width: 350px">
                <div class="card-body" style="font-size: 22px">
                    Toplam Kitap Adeti : {{ $kitapsayisi }} Adet
                </div>
            </div>
        </div>
    </div>
@endsection
