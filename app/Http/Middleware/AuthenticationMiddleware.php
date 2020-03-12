<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Helpers\GlobalHelper;

class AuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (empty(Auth::user()->verify_at)) {
                $errorMessages = GlobalHelper::getErrorMessages();

                return redirect(route('verify-notification', Auth::user()->only('verify_token')))->with($errorMessages['not_verify']);
            }

            return $next($request);
        }

        return redirect(route('index'));
    }
}
