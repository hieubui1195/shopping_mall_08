<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $adminLevel = config('custom.level.admin');

        if ($user && $user->level == $adminLevel) {
            return $next($request);
        }
        
        return redirect()->route('admin.getLogin');         
    }
}
