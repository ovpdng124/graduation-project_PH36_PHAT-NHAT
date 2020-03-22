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
use Illuminate\Http\Request;

class UserController extends Controller
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
        $params = $request->except('_token', 'password_confirmation');

        $user = $this->userService->store($params);

        $this->userService->sendMail($user->email);

        return redirect(route('user.list'))->with($this->messages['create_success']);
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
        $params = $request->except('_token');
        $user   = User::find($id);

        if ($params['email'] != $user->email) {
            $this->userService->updateIfChangedMail($params, $user);
            $this->userService->sendMail($params['email']);
        } else {
            $user->update($params);
        }

        if (strpos($request->url(), 'profile')) {
            return redirect(route('admin.profile'))->with($this->messages['update_success']);
        }

        return redirect(route('user.list'))->with($this->messages['update_success']);
    }

    public function delete($id)
    {
        User::find($id)->delete();

        return redirect()->back()->with($this->messages['delete_success']);
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

        return redirect(route('admin.profile'))->with($this->messages['change_password_success']);
    }
}
