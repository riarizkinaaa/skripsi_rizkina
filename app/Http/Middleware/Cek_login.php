<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect()
                ->route('index')
                ->withInput()
                ->with([
                    'error' => 'Anda Tidak Punya Akses '
                ]);
        }
        $user = Auth::user();


        if ($user->id_role == $roles)
            return $next($request);


        return redirect()
            ->route('index')
            ->withInput()
            ->with([
                'error' => 'Anda Tidak Punya Akses '
            ]);
    }
}
