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
        return view('admin.users.form.create');
    }

    public function store(CreateUserRequest $request)
    {
        $params = $request->except(['password_confirmation']);

        $params['password']     = bcrypt($params['password']);
        $params['verify_token'] = hash('md5', $params['email']);
        $params['verify_at']    = now();

        User::create($params);

        return redirect(route('user.list'))->with('success', 'Created successfully!');
    }

    public function show(Request $request)
    {
        $limits    = $request->get('limits', 10);
        $search    = $request->get('search', '');
        $searchKey = $request->get('searchBy', '');

        $users = $this->userService->getUsers($limits, $search, $searchKey);

        return view('admin.users.show.list', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.form.edit', compact('user'));
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
        $clearInfo = ['username' => '', 'email' => ''];

        try {
            $user->update($clearInfo);
            $user->delete();

            return redirect(route('user.list'))->with('success', 'Deleted Successfully!');
        }catch (Exception $e){
            Log::error($e);

            return redirect(route('user.list'))->with('failed', 'Deleted failed!');
        }
    }
}
