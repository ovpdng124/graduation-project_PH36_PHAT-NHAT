@extends('user.layouts.master')
@section('title','Register')

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;"
         id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Register</li>
    </ol>
    <section class="about py-5">
        <div class="card-body">
            <div class="container-fluid">
                <h1 class="text-center mb-4">Register</h1>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 well well-sm col-md-offset-4 container">
                        @if($errors->any())
                            <div class="alert alert-danger container" role="alert">
                                @foreach($errors->all() as $error)
                                    <div class="text-center">
                                        {{$error}}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{route('register')}}" method="post" class="form" role="form">
                            @csrf
                            <input type="hidden" name="role_id" value="2">
                            <input type="hidden" name="verify_token">
                            <input type="hidden" name="verify_at">
                            <div class="form-group row">
                                <div class="col-xs-3 col-md-3">
                                    <label for="" class="float-md-right mt-2">Full Name: </label>
                                </div>
                                <div class="col-xs-9 col-md-9">
                                    <input type="text" class="form-control" name="full_name" value="{{old('full_name')}}">
                                    @if($errors->any())
                                        @foreach($errors->get('full_name') as $messages)
                                            <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3 col-md-3">
                                    <label for="" class="float-md-right mt-2">Username: </label>
                                </div>
                                <div class="col-xs-9 col-md-9">
                                    <input type="text" class="form-control" name="username" value="{{old('username')}}">
                                    @if($errors->any())
                                        @foreach($errors->get('username') as $messages)
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
                                    <input type="text" class="form-control" name="email" value="{{old('email')}}">
                                    @if($errors->any())
                                        @foreach($errors->get('email') as $messages)
                                            <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-3 col-md-3">
                                    <label for="" class="float-md-right mt-2">Password: </label>
                                </div>
                                <div class="col-xs-3 col-md-9">
                                    <input type="password" class="form-control mb-1" name="password">
                                    @if($errors->any())
                                        @foreach($errors->get('password') as $messages)
                                            <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}<br></i>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3 col-md-3">
                                    <label for="" class="float-md-right mt-2">Confirm Password: </label>
                                </div>
                                <div class="col-xs-6 col-md-9">
                                    <input type="password" class="form-control" name="password_confirmation">
                                    @if($errors->any())
                                        @foreach($errors->get('password_confirmation') as $messages)
                                            <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}<br></i>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3 col-md-3">
                                    <label for="" class="float-md-right mt-2">Address: </label>
                                </div>
                                <div class="col-xs-9 col-md-9">
                                    <input type="text" class="form-control" name="address" value="{{old('address')}}">
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
                                    <input type="tel" class="form-control" name="phone_number" value="{{old('phone_number')}}">
                                    @if($errors->any())
                                        @foreach($errors->get('phone_number') as $messages)
                                            <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-block col-md-5 container"> Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
