@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card">
                <div class="card-header">List Users</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="float-right">
                            {{$users->onEachSide(1)->links()}}
                        </div>
                        <h1 class="text-center mb-4"></h1>
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
