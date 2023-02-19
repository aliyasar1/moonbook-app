<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class Admin
{

    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check() || auth()->user()->type !== User::USER_TYPE['ADMIN']){
            return redirect()->route('sellerLogin')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
        }
        return $next($request);
    }
}
