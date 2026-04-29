<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProtectedAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || !$user->is_protected) {
            abort(403, 'Akses ditolak. Hanya super admin yang bisa mengakses.');
        }

        return $next($request);
    }
}
