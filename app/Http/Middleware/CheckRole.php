<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) { // [cite: 2618]
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        // Adaptasi dari [cite: 2620] untuk menerima array
        if (!in_array($userRole, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.'); // [cite: 2621]
        }

        return $next($request); // [cite: 2623]
    }
}
