@extends('user.layouts.master')
@section('title','Create Password')

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;"
         id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Create Password</li>
    </ol>
    <section class="about py-5">
        <div class="card-body">
            <div class="container-fluid">
                <h1 class="text-center mb-4">Create Password</h1>
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
                        <form action="{{route('password-reset')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$userId->id}}">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="password" class="float-right">New password: </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" id="password" class="form-control" name="password"
                                           placeholder="Enter new Password" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="password" class="float-right">Confirm password: </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                                           placeholder="Confirmation Password" autofocus>
                                </div>
                            </div>
                            <button type="submit" style="width: 100px" class="float-right btn btn-success">Confirmation
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
