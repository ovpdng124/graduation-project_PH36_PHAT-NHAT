<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

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
            if (empty(Auth::user()->only('verify_at')['verify_at'])) {
                return redirect(route('verify-notification', Auth::user()->only('verify_token')))->with(['notification' => 'This account it not verify!', 'messages' => '']);
            }

            return $next($request);
        }

        return redirect(route('index'));
    }
}
