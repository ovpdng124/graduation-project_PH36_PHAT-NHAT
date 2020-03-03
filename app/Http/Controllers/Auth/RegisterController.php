<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Mail\VerifyMail;
use App\Services\UserService;
use Illuminate\Http\Request;
use Mail;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = app(UserService::class);
    }

    public function test()
    {
        $user = User::find(1);

        Mail::to($user->email)->send(new VerifyMail($user));
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
            return redirect(route('verify-notification'))->with(['notification' => $message, 'messages' => 'Please create again!']);
        }

        return redirect(route('verify-notification'))->with(['notification' => $message, 'messages' => 'Please check mail to verify account!']);
    }

    public function verifyNotification()
    {
        return view('user.auth.verify');
    }

    public function verify(Request $request)
    {
        $params  = $request->all();

        if (!$this->userService->decodeToken($params)){
            return redirect(route('verify-notification'))->with(['notification' => 'Verify expired', 'messages' => 'Please check mail again!']);
        }

        return redirect(route('verify-notification'))->with(['notification' => 'Verify success', 'messages' => 'You can login your account!']);

    }
}
