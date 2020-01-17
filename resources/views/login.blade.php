@extends('layouts.master')
@section('title','Login')

@section('content')
    <!-- /Banner-header -->
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;" id="home"></div>
    <!-- //Banner-header -->
    <!--//main-content-->
    <!---->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Login</li>
    </ol>
    <!---->
    <section class="about py-5">
        <div class="card-body">
            <div class="container-fluid">
                <h1 class="text-center mb-4">Login</h1>
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
                        <form action="{{route('login')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="username" class="float-right">Username: </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="username" class="form-control" name="username"
                                           placeholder="Username" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="password" class="float-right">Password: </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" id="password" class="form-control" name="password"
                                           placeholder="Password">
                                </div>
                            </div>
                            <button type="submit" style="width: 100px" class="float-right btn btn-success">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// mian-content -->
@endsection
