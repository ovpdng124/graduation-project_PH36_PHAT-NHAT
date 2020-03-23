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
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (empty($user->verify_at)) {
                $errorMessages = GlobalHelper::$messages;

                return redirect(route('notification', ['email' => $user->email]))->with($errorMessages['not_verify']);
            }

            return $next($request);
        }

        return redirect(route('index'));
    }
}
