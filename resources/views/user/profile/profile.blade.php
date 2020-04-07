@extends('user.layouts.master')
@section('title','Profile')

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
    <section class="about py-5">
        <div class="card-body">
            <div class="container-fluid">
                <h1 class="text-center mb-4">Personal Information</h1>
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
                        <div class="container border border-info p-3 font-weight-bold">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>User:</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$user->username}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Full Name:</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$user->full_name}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email: </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$user->email}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Phone: </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$user->phone_number}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Address: </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$user->address}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row ml-1 container">
                                <div class="col-5">
                                    <a type="button" class="btn btn-info" href="{{route('edit',$user->id)}}">Edit Info</a>
                                </div>
                                <div class="col-7">
                                    <a type="button" class="btn btn-success mr-3" href="{{route('list.cart')}}">Shop Cart</a>
                                    <a type="button" class="btn btn-success" href="{{route('order.info')}}">My Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
