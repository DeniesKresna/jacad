<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /*$user = Auth::user();
        if ($user){
            if ($user->hasRole("customer"))
                return redirect()->route("submission");
            elseif ($user->hasRole("superadmin") || $user->hasRole("shopadmin")) return redirect()->route("admin.home");
        }*/

        $user= auth()->user();
        
        if ($user) {
            if ($user->hasRole('customer')) {
                return redirect('/');
            } else {    
                abort(404);
            }
        }

        return $next($request);
    }
}
