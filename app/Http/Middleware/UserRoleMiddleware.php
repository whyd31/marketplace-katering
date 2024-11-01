<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        
        if (Auth::check()) {
            $user = Auth::user();
            // Periksa apakah peran pengguna sesuai dengan yang diperlukan
            if (in_array($user->role, $roles)) {
                return $next($request);
            }
        }

        // Jika tidak sesuai, kembalikan respons akses ditolak
        abort(403, 'Maaf Waktu Login Anda Telah Habis!!! Silahkan Login Kembali');
    }
}
