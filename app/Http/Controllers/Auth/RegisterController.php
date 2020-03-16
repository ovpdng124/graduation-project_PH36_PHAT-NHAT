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
    protected $errorMessages;

    public function __construct()
    {
        $this->userService   = app(UserService::class);
        $this->errorMessages = GlobalHelper::getErrorMessages();
    }

    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

    public function store(CreateUserRequest $request)
    {
        $params = $request->except('_token', 'password_confirmation');

        list($status, $token) = $this->userService->store($params);

        if (!$status) {
            return redirect(route('notification', ['verify_token' => $token]))->with($this->errorMessages['send_mail_failed']);
        }

        return redirect(route('notification'))->with($this->errorMessages['register_success']);
    }

    public function showNotification(Request $request)
    {
        $verify_token = $request->get('verify_token');

        return view('user.auth.notification', compact('verify_token'));
    }

    public function sendMail(Request $request)
    {
        $verify_token = $request->get('verify_token');

        $status = $this->userService->sendMail($verify_token);

        if (!$status) {
            return redirect(route('notification', ['verify_token' => $verify_token]))->with($this->errorMessages['send_mail_failed']);
        }

        return redirect(route('notification', ['verify_token' => $verify_token]))->with($this->errorMessages['send_mail_success']);
    }

    public function verify(Request $request)
    {
        $verify_token = $request->get('verify_token');

        $status = $this->userService->decodeToken($verify_token);

        if (!$status) {
            return abort(403, 'Expired link: Please check mail again!');
        }

        return redirect(route('notification'))->with($this->errorMessages['verify_success']);
    }
}
