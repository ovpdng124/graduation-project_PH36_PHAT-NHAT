@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <form action="{{route('user.list')}}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{request()->query('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="full_name" value="full_name" {{request()->query('searchBy') == 'full_name' ? 'checked' : ''}}>
                                    <label for="full_name">Name</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="username" value="username" {{request()->query('searchBy') == 'username' ? 'checked' : ''}}>
                                    <label for="username">Username</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="email" value="email" {{request()->query('searchBy') == 'email' ? 'checked' : ''}}>
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="phone_number" value="phone_number" {{request()->query('searchBy') == 'phone_number' ? 'checked' : ''}}>
                                    <label for="phone_number">Phone</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-left ml-3">
                        <a href="{{route('user.create')}}" class="btn btn-info float-right mb-1">
                            <i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block">Create new</span>
                        </a>
                    </div>
                    <div class="float-right">
                        {{$users->onEachSide(1)->links()}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <h1 class="text-center">List Users</h1>
                        <div class="row">
                            <table class="table-striped table">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th class="text-center" colspan="2">Action</th>
                                </tr>
                                @foreach($users as $key => $item)
                                    <tr>
                                        <td>{{$key + $users->firstItem()}}</td>
                                        <td>{{$item['full_name']}}</td>
                                        <td>{{$item['username']}}</td>
                                        <td>{{$item['email']}}</td>
                                        <td>{{$item['address']}}</td>
                                        <td>{{$item['phone_number']}}</td>
                                        <td>{{$item->role->name}}</td>
                                        <td>
                                            <a href="{{route('user.edit', $item->id)}}">
                                                <button class="btn-link">Edit</button>
                                            </a>
                                        </td>
                                        <td {{$item->role->id === \App\Entities\Role::$roles['Admin'] ? 'hidden' : ''}}>
                                            <form action="{{route('user.delete', $item->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Do you want remove this user?')" class="btn-link" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
