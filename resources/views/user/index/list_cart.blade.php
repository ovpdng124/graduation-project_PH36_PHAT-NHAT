@extends('user.layouts.master')
@section('title','Cart')

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;" id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Cart</li>
    </ol>
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container-fluid">
                <div class="card-header">
                    <div class="float-right">
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <h1 class="text-center">Your Cart</h1>
                        <div class="row">
                            <table class="table-striped table table-cart">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Images</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                <tbody class="table-body">

                                </tbody>
                            </table>
                            <div class="row container-fluid float-right">
                                <div class="col-2">
                                    <button class="btn btn-success float-right">Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom_footer_script')
    <script type="text/javascript">
        function getProducts() {
            let cart = localStorage.getItem('cart')
            $.ajax({
                type: "GET",
                url : "http://127.0.0.1:8000/product-cart",
                data: JSON.parse(cart)
            }).then(function (res) {
                $('.table-body').append(res)
            })
        }

        $(document).ready(getProducts())
    </script>
@endsection
