<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (!Auth::check()) {
            return redirect('login.form');
        }

        $userRole = Auth::user()->role->name ?? null; // ✅ updated line
        if (!$userRole) {
            abort(403, 'No role assigned to user.');
        }

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
