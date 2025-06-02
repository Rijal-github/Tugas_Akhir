<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        // Kalau belum login
        if (!$user) {
            return redirect('/login');
        }

        // Ambil nama role dari relasi
        // $userRoleName = $user->role->name ?? null;
        $userRoleName = strtolower($user->role->name ?? '');


         // Pastikan semua roles juga lowercase
        $allowedRoles = array_map('strtolower', $roles);
         // Debug log (opsional)
         Log::info('CheckRole Middleware', [
            'User ID' => $user->id,
            'User Role' => $userRoleName,
            'Allowed Roles' => $roles
        ]);


        // Cek apakah role user termasuk role yang diizinkan
        if (!in_array($userRoleName, $allowedRoles)) {
            // Bisa abort 403, atau redirect sesuai kebutuhan
            abort(403, 'Unauthorized action.');
        }    

        return $next($request);
    }
}