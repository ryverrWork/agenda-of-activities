<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        // Check if the user is authenticated and has at least one of the specified roles
        if ($request->user() && $request->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        // Redirect or abort if the user does not have the required role
        return redirect('/dashboard');
        // or use abort(403); for a forbidden response
    }
}
