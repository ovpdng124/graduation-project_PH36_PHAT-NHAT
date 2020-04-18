@extends('user.layouts.master')
@section('title','Change Password')

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;"
         id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('profile')}}">Profile</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('edit', Auth::id())}}">Edit</a>
        </li>
        <li class="breadcrumb-item active">Change Password</li>
    </ol>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="float-left ml-3">
                            <a href="{{url()->previous()}}" class="btn btn-info float-right"><i class="fa fa-arrow-left mr-1"></i>Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <h1 class="text-center mb-4">Change password</h1>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-7 well well-sm col-md-offset-4 container">
                                    <form action="{{route('update-password')}}" method="post" class="form" role="form">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Old Password: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="password" class="form-control" name="current_password"
                                                       value="">
                                                @if($errors->any())
                                                    @foreach($errors->get('current_password') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}
                                                            <br></i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">New Password: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="password" class="form-control" name="new_password"
                                                       value="">
                                                @if($errors->any())
                                                    @foreach($errors->get('new_password') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}
                                                            <br></i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Confirm Password: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="password" class="form-control" name="password_confirmation"
                                                       value="">
                                                @if($errors->any())
                                                    @foreach($errors->get('password_confirmation') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}
                                                            <br></i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit"
                                                class="btn btn-lg btn-primary btn-block col-md-5 container"> Change
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
