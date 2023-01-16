@extends('layouts.kullanicilar.master')

@section('content')
    <div class="container my-5">
        <h2>Yayın Evleri</h2>
        <hr>
        <div class="d-grid justify-content-lg-between" style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr">
            @foreach($yayinevleri as $yayinevi)
                <div class=" col-log-3 px-3 py-3">
                    <div class="card shadow-lg border-0" style="width: 220px;">
                        <div class="card-body text-center">
                            <a href="{{ route('yayin_evleri_kitaplari', $yayinevi->id) }}" class="text-decoration-none">{{ $yayinevi->adi }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
