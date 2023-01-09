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
            abort(403);
        }
        return $next($request);
    }
}
