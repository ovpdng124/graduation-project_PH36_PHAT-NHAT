@extends('user.layouts.master')
@section('title','Notification')

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;"
         id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Notification</li>
    </ol>
    <section class="about py-5">
        <div class="card-body">
            <div class="container-fluid">
                <h1 class="text-center mb-4">{{Session::get('notification')}}</h1>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 well well-sm col-md-offset-4 container">
                        <div class="container">
                            <p class="alert alert-default-success container text-center">{{Session::get('messages')}}</p>
                            @if(!empty($verify_token))
                                <p class="text-center"><a href="{{route('send-mail', $verify_token)}}"><i> Click here to send mail again</i></a></p>
                            @endif
                            @if(!Auth::check())
                                <p class="text-center"><a class="text-center container" href="{{route('login-form')}}">Login</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
