<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAccount
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
        return $next($request);
        if (Auth::check()) {
            $user = auth()->user();
            if($user->bankAccount){
                return $next($request);
            }else{
                return redirect()->route('user.account-setup');
            }
        }
        abort(403);
    }
}