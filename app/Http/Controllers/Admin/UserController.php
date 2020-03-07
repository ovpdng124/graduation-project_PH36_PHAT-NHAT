<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Log;

class UserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = app(UserService::class);
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
        $user   = $this->userService->store($params);

        if (!$user) {
            return redirect(route('user.list'))->with('failed', 'Create failed!');
        }

        return redirect(route('user.list'))->with('success', 'Created successfully!');
    }

    public function show(Request $request)
    {
        $limits    = $request->get('limits', 10);
        $search    = $request->get('search', '');
        $searchKey = $request->get('searchBy', '');

        $users = $this->userService->getUsers($limits, $search, $searchKey);

        return view('admin.users.list', compact('users', 'search', 'searchKey'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(EditUserRequest $request, $id)
    {
        $params = $request->except('_token');

        User::find($id)->update($params);

        return redirect(route('user.list'))->with('success', 'Updated successfully!');
    }

    public function delete($id)
    {
        $user = User::find($id);

        try {
            $user->delete();

            return redirect(route('user.list'))->with('success', 'Deleted Successfully!');
        } catch (Exception $e) {
            Log::error($e);

            return redirect(route('user.list'))->with('failed', 'Deleted failed!');
        }
    }
}
