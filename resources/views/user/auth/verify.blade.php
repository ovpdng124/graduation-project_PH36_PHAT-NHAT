@extends('user.layouts.master')
@section('title','Register')

@section('content')
    <!-- /Banner-header -->
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;"
         id="home"></div>
    <!-- //Banner-header -->
    <!--//main-content-->
    <!---->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Register</li>
    </ol>
    <!---->
    <section class="about py-5">
        <div class="card-body">
            <div class="container-fluid">
                <h1 class="text-center mb-4">Register</h1>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 well well-sm col-md-offset-4 container">
                        <div class="container">
                            @if(Session::has('messages'))
                                <h4 class="alert alert-default-success container text-center">{{Session::get('notification')}}</h4>
                                <p class="alert alert-default-success container text-center">{{Session::get('messages')}}</p>
                            @endif
                        </div>
                    </div>
                    <a class="text-center container" href="{{route('login-form')}}">Login</a>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.login-box -->
    <script src="{{mix('js/auth/login.js')}}"></script>
@endsection
