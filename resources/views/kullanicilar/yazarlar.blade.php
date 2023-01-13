@extends('layouts.kullanicilar.master')

@section('content')
    <div class="container my-5">
        <h2>Yazarlar</h2>
        <hr>
        <div class="d-grid justify-content-lg-between" style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr">
            @foreach($yazarlar as $yazar)
                <div class=" col-log-3 px-3 py-3">
                    <div class="card shadow-lg border-0" style="width: 220px;">
                        <div class="card-body text-center">
                            <a href="{{ route('yazar_kitaplari', $yazar->id) }}" class="text-decoration-none">{{ $yazar->adi_soyadi }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
