<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\GlobalHelper;
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
    protected $messages;

    public function __construct()
    {
        $this->userService = app(UserService::class);
        $this->messages    = GlobalHelper::$messages;
    }

    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

    public function store(CreateUserRequest $request)
    {
        $params = $request->except('_token', 'password_confirmation');

        $user = $this->userService->store($params);

        $this->userService->sendMail($user->email);

        return redirect(route('notification'))->with($this->messages['register_success']);
    }

    public function showNotification(Request $request)
    {
        $email = $request->get('email');

        return view('user.auth.notification', compact('email'));
    }

    public function sendMailAgain(Request $request)
    {
        $email = $request->get('email');

        $status = $this->userService->sendMail($email);

        if (!$status) {
            return redirect(route('notification', ['email' => $email]))->with($this->messages['send_mail_failed']);
        }

        return redirect(route('notification'))->with($this->messages['send_mail_success']);
    }

    public function verify(Request $request)
    {
        $verify_token = $request->get('verify_token');

        list($email, $dateTime) = $this->userService->decodeToken($verify_token);

        $status = $this->userService->verifyAccount($email, $dateTime);

        if (!$status) {
            return abort(403, 'Expired link: Please check mail again!');
        }

        return redirect(route('notification'))->with($this->messages['verify_success']);
    }
}
