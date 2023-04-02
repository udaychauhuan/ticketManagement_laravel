<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminRouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     //it prevent the user to access the admin route
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->UserType == 1) {
            return $next($request);
        }
        return redirect()->route('User.home');
    }
}
