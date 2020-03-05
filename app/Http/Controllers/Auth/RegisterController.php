<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct()
    {
        $this->userService = app(UserService::class);
    }

    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

    public function store(CreateUserRequest $request)
    {
        $params = $request->except(['_token', 'password_confirmation']);

        list($status, $message) = $this->userService->store($params);

        if (!$status) {
            return redirect(route('verify-notification'))->with(['notification' => $message, 'messages' => 'Please login to send mail again!']);
        }

        return redirect(route('verify-notification'))->with(['notification' => $message, 'messages' => 'Please check mail to verify account!']);
    }

    public function verifyNotification(Request $request)
    {
        $verify_token = $request->all();

        return view('user.auth.verify', compact('verify_token'));
    }

    public function sendMail(Request $request)
    {
        $token = $request->all();

        $this->userService->sendMail($token['verify_token']);


        return redirect(route('verify-notification', $token))->with(['notification' => 'Success', 'messages' => 'Check your email to verify!']);
    }

    public function verify(Request $request)
    {
        $params = $request->all();

        if (!$this->userService->decodeToken($params)) {

            return abort(403, 'Please check mail again!');
        }

        return redirect(route('verify-notification'))->with(['notification' => 'Verify success', 'messages' => 'You can login your account!']);
    }
}
