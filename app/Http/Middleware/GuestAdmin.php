<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('admin')) {
            return redirect('/admin');
        }

        return $next($request);
    }
}