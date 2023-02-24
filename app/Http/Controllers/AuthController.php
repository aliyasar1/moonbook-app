<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Cart;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\False_;

class AuthController extends Controller
{

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        $inputs = $request->all();

        $user = User::query()
            ->where('email', $inputs['email'])
            ->where('sifre', base64_encode($inputs['sifre']))
            ->first();

        if (!$user || !$inputs) {
            return redirect()->route('login')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
        } else {
            if ($user->type === User::USER_TYPE['ADMIN']) {

                Auth::login($user);
                return redirect()->route('seller.home');

            } elseif ($user->type === User::USER_TYPE['USER']) {

                Auth::login($user);

                Cart::query()->firstOrCreate(
                    ['kullanici_id' => Auth::user()->id, 'is_active' => 1],
                    ['kod' => Str::random(8)]
                );

                return redirect()->route('home');
            }
        }
        return false;
    }

    public function getRegister(User $user)
    {
        $cities = Cities::query()
            ->with(['ilceler'])
            ->get();

        return view('register', compact('user', 'cities'));
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fotograf' => 'sometimes',
                'adi_soyadi' => 'required',
                'kullanici_adi' => 'required|min:8',
                'email' => 'required|email',
                'tel_no' => 'min:11|max:11',
                'sifre' => 'required|min:6',
                'sifre_tekrar' => 'required_with:sifre|same:sifre',
                'il_id' => 'required',
                'ilce_id' => 'required',
                'adres' => 'required'
            ],

            [
                'sifre.required' => 'Şifre alanı boş geçilemez.',
                'sifre.min' => 'Şifre En az 6 karakter olmalıdır.',
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
        $inputs = $validator->validate();

        $file = $request->file('fotograf');

        if (is_null($file)) {
            $fileName = 'default.png';
            $inputs['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/musteriler', $fileName);

            $inputs['fotograf'] = $fileName;
        }
        $inputs['sifre'] = base64_encode($request->sifre);
        $inputs['sifre_tekrar'] = base64_encode($request->sifre_tekrar);

        User::query()->create($inputs);

        return redirect()->route('login');
    }

    public function getSellerRegister(User $user)
    {
        $cities = Cities::query()
            ->with(['ilceler'])
            ->get();

        return view('admin.sellerRegister', compact('user', 'cities'));
    }

    public function postSellerRegister(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'firma_adi' => 'required',
                'tckn' => 'required|numeric',
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
                'firma_adi.required' => 'Firma Adı alanı boş geçilemez',
                'tckn.required' => 'VKN/TCKN alanı boş geçilemez',
                'tckn.numeric' => 'VKN/TCKN alanına sadece sayı girişi yapılabilir.',
                'sifre.required' => 'Şifre alanı boş geçilemez.',
                'sifre.min' => 'Şifre En az 6 karakter olmalıdır.',
                'kullanici_adi.required' => 'Kullanıcı adı alanı boş geçilemez',
                'email.required' => 'Email alanı boş geçilemez',
                'tel_no.min' => 'Telefon Numarası 11 haneli olmalıdır.',
                'tel_no.required' => 'Telefon Numarası alanı boş geçilemez.',
                'sifre_tekrar.same' => 'Girilen şifreler aynı değildir.',
                'adi_soyadi.required' => 'Ad Soyad alanı boş geçilemez.',
                'il_id' => 'İl alanı boş geçilemez.',
                'ilce_id' => 'İlçe alanı boş geçilemez.',
                'adres' => 'Adres alanı boş geçilemez.',
            ]
        );

        $inputs = $validator->validate();
        $inputs['type'] = User::USER_TYPE['ADMIN'];

        $file = $request->file('fotograf');

        if (is_null($file)) {
            $fileName = 'magaza.png';
            $inputs['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/saticilar', $fileName);

            $inputs['fotograf'] = $fileName;
        }
        $inputs['sifre'] = base64_encode($request->sifre);
        $inputs['sifre_tekrar'] = base64_encode($request->sifre_tekrar);

        User::query()->create($inputs);

        return redirect()->route('sellerLogin');
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function postDistrictByCity(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'il_id' => 'required'
            ],
            [
                'il_id.required' => 'İl ID Gereklidir'
            ]
        );

        $inputs = $validator->validate();

        $districts = Districts::query()->where('il_id', $inputs['il_id'])->get();

        return response()->json($districts);
    }

}
