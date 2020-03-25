@extends('user.layouts.master')
@section('title','Edit Profile')

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;"
         id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
    <div class="container">
        @if(Session::has('success'))
            <div class="bg-success alert col-md-4 text-bold container text-center">{{Session::get('success')}}</div>
        @elseif(Session::has('failed'))
            <div class="bg-danger alert col-md-4 text-bold container text-center">{{Session::get('failed')}}</div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="float-left ml-3">
                            <a href="{{url()->previous()}}" class="btn btn-info float-right"><i class="fa fa-arrow-left mr-1"></i>Back</a>
                        </div>
                        <div class="float-right ml-3">
                            <a href="{{route('edit-password')}}">
                                <button type="submit" class="btn btn-lg btn-info btn-block col-md-12 container"> Change Password</button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <h1 class="text-center mb-4">Information</h1>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-7 well well-sm col-md-offset-4 container">
                                    <form action="{{route('update',$user->id)}}" method="post" class="form" role="form">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Full Name: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="full_name"
                                                       value="{{$user->full_name}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('full_name') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Email: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="email"
                                                       value="{{$user->email}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('email') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Address: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="address"
                                                       value="{{$user->address}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('address') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Phone: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="tel" class="form-control" name="phone_number"
                                                       value="{{$user->phone_number}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('phone_number') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <button type="submit"
                                                    class="btn btn-lg btn-primary btn-block col-md-6 container"> Update
                                            </button>
                                        </div>
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
