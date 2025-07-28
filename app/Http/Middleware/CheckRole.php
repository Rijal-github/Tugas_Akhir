<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = Auth::user();

        // Kalau belum login
        if (!$user) {
            return redirect('/login');
        }

        $userPermissions = $user->role?->permissions->pluck('akses')->map(fn($p) => strtolower($p))->toArray() ?? [];

        $allowedPermissions = array_map('strtolower', $permissions);

        // Debug log opsional
        Log::info('CheckPermission Middleware', [
            'User ID' => $user->id,
            'User Permissions' => $userPermissions,
            'Allowed Permissions' => $allowedPermissions,
        ]);

        // Cek apakah minimal satu permission cocok
        foreach ($allowedPermissions as $permission) {
            if (in_array($permission, $userPermissions)) {
                return $next($request);
            }
        }

        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
        // $user = Auth::user();

        // // Kalau belum login
        // if (!$user) {
        //     return redirect('/login');
        // }

        // // Ambil nama role dari relasi
        // // $userRoleName = $user->role->name ?? null;
        // $userRoleName = strtolower($user->role->name ?? '');


        //  // Pastikan semua roles juga lowercase
        // $allowedRoles = array_map('strtolower', $roles);
        //  // Debug log (opsional)
        //  Log::info('CheckRole Middleware', [
        //     'User ID' => $user->id,
        //     'User Role' => $userRoleName,
        //     'Allowed Roles' => $roles
        // ]);


        // // Cek apakah role user termasuk role yang diizinkan
        // if (!in_array($userRoleName, $allowedRoles)) {
        //     // Bisa abort 403, atau redirect sesuai kebutuhan
        //     abort(403, 'Unauthorized action.');
        // }    

        // return $next($request);

