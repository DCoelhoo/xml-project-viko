<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminTimeout
{
    public function handle(Request $request, Closure $next)
    {
        // IF ADMIN NOT LOGGED IN → continue
        if (!session()->has('admin')) {
            return $next($request);
        }

        $timeout = 5 * 60; // 5 minutes (in seconds)
        $lastActivity = session('last_activity_time');

        if ($lastActivity && (time() - $lastActivity > $timeout)) {

            // Clear session and logout
            session()->forget('admin');
            session()->forget('last_activity_time');

            return redirect('/admin/login')
                ->with('error', 'Session expired due to inactivity.');
        }

        // Update timestamp
        session(['last_activity_time' => time()]);

        return $next($request);
    }
}