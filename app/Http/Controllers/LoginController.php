<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Books;
use App\Models\Cart;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //Customer
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $inputs = $request->all();
        $user = User::query()
            ->where('email', $inputs['email'])
            ->where('sifre', base64_encode($inputs['sifre']))
            ->first();

        if (! is_null($user) && $user->type === User::USER_TYPE['ADMIN']) {
            return redirect()->route('login')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
        } elseif (! is_null($user) && $user->type === User::USER_TYPE['USER']) {
            Auth::login($user);

            Cart::query()->firstOrCreate(
                ['kullanici_id' => Auth::user()->id, 'is_active' => 1],
                ['kod' => Str::random(8)]
            );

            return redirect()->route('home');
        }
        return redirect()->route('login')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
    }

    // Seller
    public function getSellerLogin()
    {
        return view('admin.login');
    }

    public function postSellerLogin(LoginRequest $request)
    {
        $inputs = $request->all();

        $user = User::query()
            ->where('email', $inputs['email'])
            ->where('sifre', base64_encode($inputs['sifre']))
            ->first();

        if (! $user || $user->type === User::USER_TYPE['USER']) {
            return redirect()->route('sellerLogin')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
        }

        Auth::login($user);
        return redirect()->route('seller.home');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
