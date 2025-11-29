<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = session('user');

        if (!$user) {
            // Not logged in – redirect to login
            return redirect()->route('user.login.form')->with('error', 'Please login first.');
        }

        if (!in_array($user['type'], $roles)) {
            // Logged in, but not authorized
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}

