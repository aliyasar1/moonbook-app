@php
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.admin.master')

@section('title')
    <title>MoonBook | Siparişler</title>
@endsection

@section('content')
    <div class="container" style="max-width: 1600px; min-height: 700px">
        <h3><b><u>{{ $order->kod }}</u></b> Kodlu Sipariş</h3>
        <hr>
        <table class="table">
            <thead class="bg-danger text-white text-center">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Fotoğraf</th>
                <th scope="col">Kategori</th>
                <th scope="col">Kitap Adı</th>
                <th scope="col">Yazar</th>
                <th scope="col">Yayın Evi</th>
                <th scope="col">Fiyat</th>
                <th scope="col">Miktar</th>
                <th scope="col">Toplam Fiyat</th>
                <th scope="col">Alıcı</th>
                <th scope="col">Sipariş Durumu</th>
                <th scope="col">İşlem</th>
            </tr>
            </thead>
            <tbody class="flex-row justify-content-center align-items-center">
            @foreach($orderDetail as $detail)
                    <tr class="text-center h-100">
                        <td class="align-middle">{{ $detail->kitap->id }}</td>
                        <td class="px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="ratio3x2" style="width: 50px"
                                 src="{{ asset('storage/saticilar/kitaplar/'. $detail->kitap->fotograf )}}"
                                 alt="{{ $detail->kitap->adi }}"></td>
                        <td class="align-middle">{{ $detail->kitap->kategoriler->adi }}</td>
                        <td class="align-middle">{{ $detail->kitap->adi }}</td>
                        <td class="align-middle">{{ $detail->kitap->yazarlar->adi_soyadi }}</td>
                        <td class="align-middle">{{ $detail->kitap->yayin_evleri->adi }}</td>
                        <td class="align-middle">₺ {{ $detail->kitap->fiyat }}</td>
                        <td class="align-middle">{{ $detail->miktar }}</td>
                        <td class="align-middle">₺ {{ $detail->fiyat }}</td>
                        <td class="align-middle">{{ $detail->siparisler->sepet->kullanicilar->adi_soyadi }}</td>
                        <form method="post" action="{{ route('seller.putOrderStatus', $detail->id) }}"
                              onsubmit="return confirm('Sipariş durumu değiştirilecek, onaylıyor musunuz?')"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <td class="align-middle">
                                <label for="status_id" hidden></label>
                                <select name="status_id" id="status_id" class="form-control text-center">
                                    <option value="{{ $detail->status_id }}">{{ $detail->order_status->status }}</option>
                                    <option value="" disabled>--------------------</option>
                                    @foreach($orderStatuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="align-middle">
                                <button type="submit" class="btn btn-success"><i
                                            class="fa-solid fa-check"></i></button>
                            </td>
                        </form>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection