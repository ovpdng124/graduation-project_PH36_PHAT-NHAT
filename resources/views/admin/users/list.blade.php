@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="hidden" name="searchBy" value="code">
                                <input type="text" class="form-control" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-left ml-3">
                        <a href="{{route('user.create-form')}}" class="btn btn-info float-right mb-1">
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
                                        <td><a href="{{route('user.edit-form', $item->id)}}"><button class="btn-link">Edit</button></a></td>
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
