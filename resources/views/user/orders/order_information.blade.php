@extends('user.layouts.master')
@section('title','My Order')
@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;"
         id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('profile')}}">Profile</a>
        </li>
        <li class="breadcrumb-item active">Order information</li>
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
                        <h1 class="text-center">My orders</h1>
                        <div class="float-right">
                            {{$orders->onEachSide(1)->links()}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <table class="table-striped table">
                                    <tr>
                                        <th>#</th>
                                        <th>Order Code</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                    </tr>
                                    @foreach($orders as $key => $item)
                                        <tr>
                                            <td>{{$key + $orders->firstItem()}}</td>
                                            <td width="50%"><a href="{{route('user.order.detail', $item->id)}}">{{$item->order_label}}</a></td>
                                            <td width="20%">$ {{number_format($item->total_price)}}</td>
                                            <td width="20%"><span style="width: 100px" class="badge badge-pill badge-{!! $item->color_status !!}">{!! $item->name_status !!}</span></td>
                                        </tr>
                                    @endforeach
                                </table>
                                @if(count($orders) == 0)
                                    <div class="text-center container-fluid">
                                        <p><i>There are no orders to list</i></p>
                                        <a class="btn btn-link" href="{{url()->previous()}}">Back</a>
                                    </div>
                                @endif
                            </div>
                            <div class="container">
                                <a href="{{url()->previous()}}" class="float-right btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
