<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check bahwa user adalah bukan admin
        if (!auth()->check() || auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }
        
        return $next($request);
    }
}
