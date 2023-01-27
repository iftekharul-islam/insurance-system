<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $roles = explode("|", $role);
        //check role permission
        foreach($roles as $r){
            if((Auth::user()->is_admin == 1 && $r == '1')
            || (Auth::user()->is_admin == 2 && $r == '2')
            || (Auth::user()->is_admin == 3 && $r == '3')
            || (Auth::user()->is_admin == 4 && $r == '4'))
            {
                return $next($request);
            }
        }
        //not admin redirection
        return redirect('home')->with('error', 'You don\'t have enough permission to do this action.');
    }
}
