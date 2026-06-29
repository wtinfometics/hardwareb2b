<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if session exists
        if (!session()->has('admin_auth')) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        // Continue to the requested route
        return $next($request);
 
    }
}
