@extends('user.layouts.master')
@section('title','Forgot Password')

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;"
         id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('login-form')}}">Login</a>
        </li>
        <li class="breadcrumb-item active">Forgot Password</li>
    </ol>
    <section class="about py-5">
        <div class="card-body">
            <div class="container-fluid">
                <h1 class="text-center mb-4">Forgot Password</h1>
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
                        <form action="{{route('send-password-mail')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="email" class="float-right">Email: </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="email" class="form-control" name="email"
                                           placeholder="Enter email to retrieve your password." autofocus>
                                </div>
                            </div>
                            <button type="submit" class="float-right btn btn-success">Send Mail</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
