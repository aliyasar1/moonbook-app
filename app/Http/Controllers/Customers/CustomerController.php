<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Favorites;
use App\Models\Districts;
use App\Models\Cities;
use App\Models\Category;
use App\Models\Books;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Stock;
use App\Models\User;
use App\Models\PublishingHouses;
use App\Models\Writers;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getHome()
    {
        $kitapRoman = Books::query()
            ->where('kategori_id', 3)
            ->limit(4)
            ->get();

        $kitapKG = Books::query()
            ->where('kategori_id', 4)
            ->limit(4)
            ->get();

        $kitapCR = Books::query()
            ->where('kategori_id', 9)
            ->limit(4)
            ->get();

        $kitapAT = Books::query()
            ->where('kategori_id', 6)
            ->limit(4)
            ->get();

        $anasayfaYorumlar = Comments::query()
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        return view('customers.home', compact('kitapRoman', 'kitapKG', 'kitapCR', 'kitapAT', 'anasayfaYorumlar'));
    }

    public function getEditProfile()
    {
        $user = Auth::user();
        $iller = Cities::query()
            ->with(['ilceler'])
            ->get();

        $ilceler = $iller->where('il', $user->il_id)->first();

        return view('customers.editProfile', compact('user', 'iller', 'ilceler'));
    }

    public function putEditProfile(Request $request, User $user)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'adi_soyadi' => 'required',
                'kullanici_adi' => 'required',
                'tel_no' => 'required|numeric',
                'email' => 'required|email',
                'sifre' => 'required|min:6',
                'sifre_tekrar' => 'required_with:sifre|same:sifre',
                'adres' => 'required',
                'il_id' => 'required',
                'ilce_id' => 'required',
            ],
            [
                'sifre.required' => 'Şifre alanı boş geçilemez.',
                'sifre.min' => 'Şifre En az 6 karakter olmalıdır.' ,
                'kullanici_adi.required' => 'Kullanıcı adı alanı boş geçilemez',
                'kullanici_adi.unique' => 'Kullanıcı adı alınmıştır.',
                'email.required' => 'Email alanı boş geçilemez',
                'email.unique' => 'Bu Email adresi kayıtlıdır.',
                'tel_no.min' => 'Telefon Numarası 11 haneli olmalıdır.',
                'sifre_tekrar.same' => 'Girilen şifreler aynı değildir.',
                'adi_soyadi.required' => 'Ad Soyad alanı boş geçilemez.',
                'il_id' => 'İl alanı boş geçilemez.',
                'ilce_id' => 'İlçe alanı boş geçilemez.',
                'adres' => 'Adres alanı boş geçilemez.',
            ]
        );

        $inputsProfile = $validator->validate();

        $file = $request->file('fotograf');

        if (is_null($file)) {
            $fileName = $user->fotograf;
            $inputsProfile['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/musteriler', $fileName);

            $inputsProfile['fotograf'] = $fileName;
        }

        $inputsProfile['sifre'] = base64_encode($request->sifre);
        $inputsProfile['sifre_tekrar'] = base64_encode($request->sifre_tekrar);

        $user->update($inputsProfile);

        return redirect()->route('editProfile');
    }

    public function getAllOrders() {
        $deactiveSepetler = Cart::query()
            ->with(['sepetDetaylari', 'sepetDetaylari.kitaplar','siparis', 'siparis.siparis_detaylari'])
            ->where('is_active', 0)
            ->where('kullanici_id', Auth::user()->id)
            ->orderByDesc('id')
            ->get();

        return view('customers.allOrders', compact('deactiveSepetler'));
    }

    public function getOrderDetail(Orders $siparis)
    {
        return view('customers.orderDetail', compact('siparis'));
    }

    public function getKVKK()
    {
        return view('customers.kvkk');
    }

}
