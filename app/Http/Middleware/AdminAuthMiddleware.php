<?php

namespace App\Http\Middleware;

use App\Helpers\GlobalHelper;
use Closure;

class AdminAuthMiddleWare
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
        if (GlobalHelper::checkAdminRole()){
            return $next($request);
        }

        return redirect(route('index'));
    }
}
