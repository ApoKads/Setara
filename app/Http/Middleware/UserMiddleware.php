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
        if (auth()->check() && auth()->user()->role === 'user') {
            return $next($request);
        }
        if (!auth()->check()) {
            return redirect('/');
        }
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        if (auth()->user()->role === 'company') {
            return redirect('/company/dashboard');
        }
    }
}
