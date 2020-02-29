<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

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

        return redirect(route('admin.index'))->with('success', 'Created successfully!');
    }

    public function show(Request $request)
    {
        $limits    = $request->get('limits', 10);
        $search    = $request->get('search', '');
        $searchKey = $request->get('searchBy', '');

        $users = $this->userService->getUsers($limits, $search, $searchKey);

        return view('admin.users.show.list', compact('users'));
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
