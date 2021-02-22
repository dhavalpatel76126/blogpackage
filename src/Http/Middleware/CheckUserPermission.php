<?php
namespace Cct\Blog\Http\Middleware;

use Cct\Blog\Helpers\PermissionHelper;
use Closure;
use Illuminate\Http\Request;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(PermissionHelper::__checkPermission()){
            return $next($request);
        } else {
            return redirect()->route('login')->with('Something went wrong');
        }
    }
}