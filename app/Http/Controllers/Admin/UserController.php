<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordProfileRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Services\UserService;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Log;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;
    protected $message;

    public function __construct()
    {
        $this->userService = app(UserService::class);
        $this->message     = GlobalHelper::getErrorMessages();
    }

    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $params = $request->except(['_token', 'password_confirmation']);

        list($status, $string) = $this->userService->store($params);

        if (!$status) {
            return redirect(route('notification', ['verify_token' => $string]))->with($this->message['send_mail_failed']);
        }

        return redirect(route('user.list'))->with('success', $string);
    }

    public function show(Request $request)
    {
        $limits    = $request->get('limits', 10);
        $search    = $request->get('search', '');
        $searchKey = $request->get('searchBy', '');

        $users = $this->userService->getUsers($limits, $search, $searchKey);

        return view('admin.users.list', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(EditUserRequest $request, $id)
    {
        $params = $request->except('_token', 'url');
        $user   = User::find($id);

        list($status, $string) = $this->userService->update($params, $user);

        if (!$status) {
            return redirect(route('notification', ['verify_token' => $string]))->with($this->message['send_mail_failed']);
        }

        return redirect($request->get('url'))->with('success', $string);
    }

    public function delete($id)
    {
        User::find($id)->delete();

        return redirect()->back()->with('failed', 'Deleted successfully!');
    }

    public function profile()
    {
        $userProfile = Auth::user();

        return view('admin.users.profile', compact('userProfile'));
    }

    public function changePasswordProfile(Request $request)
    {
        $userId = $request->get('id');

        return view('admin.users.profile_edit_password', compact('userId'));
    }

    public function updatePasswordProfile(ChangePasswordProfileRequest $request)
    {
        $params = $request->except('_token', 'password_confirmation');

        $status = $this->userService->updatePasswordProfile($params);

        if (!$status) {
            return redirect()->back()->withErrors(['current_password' => 'Wrong password!']);
        }

        return redirect(route('admin.profile'))->with('success', 'Changed password successfully!');
    }
}
