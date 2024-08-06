<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use Symfony\Component\HttpFoundation\Response;

class ActivityTimeout
{
    // /**
    //  * Handle an incoming request.
    //  *
    //  * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    //  */

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $timeout = 30 * 60; // 30 menit dalam detik

        if (Auth::check()) {
            $lastActivity = Session::get('lastActivityTime');
            $currentTime = time();

            if ($lastActivity && ($currentTime - $lastActivity) > $timeout) {
                Auth::logout();
                Session::forget('lastActivityTime');
                return redirect('login')->with('message', 'Sesi anda telah berakhir karena tidak ada aktivitas.');
            }

            Session::put('lastActivityTime', $currentTime);
        }

        return $next($request);
    }
}
