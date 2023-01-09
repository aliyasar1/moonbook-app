<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        $user = User::query()->where('email', $request->email)->where('sifre', base64_encode($request->sifre))->firstOrFail();
        if ($user->type === User::USER_TYPE['ADMIN']) {
            return view('admin.anasayfa');
        } elseif ($user->type === User::USER_TYPE['USER']) {
            abort(403);
        }
    }
}
