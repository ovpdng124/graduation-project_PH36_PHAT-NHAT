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
        $params = $request->except(['_token', 'password_confirmation']);

        list($status) = $this->userService->store($params);

        if (!$status) {
            return redirect(route('verify-notification'))->with($this->errorMessages['send_mail_failed']);
        }

        return redirect(route('verify-notification'))->with($this->errorMessages['create_success']);
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

        return redirect(route('verify-notification', $token))->with($this->errorMessages['send_mail']);
    }

    public function verify(Request $request)
    {
        $params = $request->all();

        if (!$this->userService->decodeToken($params)) {
            return abort(403, 'Please check mail again!');
        }

        return redirect(route('verify-notification'))->with($this->errorMessages['verify_success']);
    }
}
