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
            <a href="{{route('order.info')}}">Order information</a>
        </li>
        <li class="breadcrumb-item active">Detail order</li>
    </ol>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="container">
                        <div class="m-4">
                            <h1 class="text-center">Detail Order</h1>
                        </div>
                        <div class="row  font-weight-bold">
                            <div class="col-6">
                                <div class="row">
                                    <label for="" class="col-2 float-right">Name</label>
                                    <span>: {{$order->user->full_name}}</span>
                                </div>
                                <div class="row">
                                    <label for="" class="col-2">Address</label>
                                    <span>: {{$order->user->address}}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="" class="col-3">Status</label>
                                        <span>: {{$order->name_status}}</span>
                                </div>
                                <div class="row">
                                    <label for="" class="col-3">Discount</label>
                                    <span>: {{($order->is_sale) ? 'Yes' : 'No'}}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="" class="col-2">Phone</label>
                                    <span>: {{$order->user->phone_number}}</span>
                                </div>
                                <div class="row">
                                    <label for="" class="col-2">Email</label>
                                    <span>: {{$order->user->email}}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="" class="col-3">Discount Price</label>
                                    <span>: {{($order->is_sale) ? '$ '.number_format($order->sale_price) : '-'}}</span>
                                </div>
                                <div class="row">
                                    <label for="" class="col-3">Total Price</label>
                                    <span>: {{'$ '.number_format($order->total_price)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="30%">Name</th>
                                        <th width="30%">Unit Price</th>
                                        <th width="10%">Quantity</th>
                                        <th width="10%">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product_attributes as $key  => $item)
                                        <tr>
                                            <td width="2%">{{++$key}}</td>
                                            <td width="40%">{{$item->sub_name}}</td>
                                            <td width="20%">$ {{number_format($item->price)}}</td>
                                            <td width="5%">{{$item->quantity}}</td>
                                            <td width="25%">$ {{number_format($item->total)}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="container">
                                    <a href="{{url()->previous()}}" class="float-right btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
