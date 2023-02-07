<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        $user = User::query()->where('email', $request->email)->where('sifre', base64_encode($request->sifre))->first();
        if (! is_null($user) && $user->type === User::USER_TYPE['ADMIN']) {
            return view('admin.anasayfa');
        } elseif (! is_null($user) && $user->type === User::USER_TYPE['USER']) {
            return redirect()->route('satici_girisi_yap')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
        }
        return redirect()->route('satici_girisi_yap')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
    }
}
