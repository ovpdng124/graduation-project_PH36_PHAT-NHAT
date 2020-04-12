@extends('user.layouts.master')
@section('title','Create Order')
@section('custom_import')
    <script src="{{mix('js/app.js')}}"></script>
@endsection

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;" id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{url()->previous()}}">Cart</a>
        </li>
        <li class="breadcrumb-item active">Create Order</li>
    </ol>
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container-fluid">
                <div class="card-header">
                    <div class="text-center">
                        <h1>Your Order</h1>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_footer_script')
    <script src="{{mix('/js/orders/list.js')}}"></script>
@endsection
