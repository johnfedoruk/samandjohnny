<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Session;


class ACL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
      $roles = Session::get("roles");
      if(Auth::check()&&Auth::user()->hasRoles($roles))
        return $next($request);
      return redirect('/');
    }
}
