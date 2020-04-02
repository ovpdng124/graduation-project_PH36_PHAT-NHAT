@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Order information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="text-bold d-inline">Name:</p>
                                <p class="d-inline">{{$order->user->full_name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="text-bold d-inline">Phone:</p>
                                <p class="d-inline">{{$order->user->phone_number}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="mb-0">
                                    <span class="text-bold ">Is Sale : </span>
                                    {{($order->is_sale) ? 'Yes' : 'No'}}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="mb-0">
                                    <span class="text-bold ">Sale Price: </span>
                                    $ {{!empty($order->sale_price) ? number_format($order->sale_price) : '-'}}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="mb-0">
                                    <span class="text-bold ">Status: </span>

                                    {{--                                        <a href="{{route('order.change_status')}}">--}}
                                    {{--                                        <select id="order_status" >--}}
                                    {{--                                            @foreach($orders as $key => $value)--}}
                                    {{--                                                @if($order->status == $value)--}}
                                    {{--                                                    <option id="selected_status" value="{{$order->status}}" selected>{{$key}}</option>--}}
                                    {{--                                                @else--}}
                                    {{--                                                    <option id="status_order" value="{{$value}}">{{$key}}</option>--}}
                                    {{--                                                @endif--}}
                                    {{--                                            @endforeach--}}
                                    {{--                                        </select>--}}
                                    {{--                                        </a>--}}
                                </p>
                                <div class="dropdown">
                                    @foreach($orders as $key => $value)
                                        @if($order->status == $value)
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <a href="">{{$key}}</a>
                                            </button>
                                        @else
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">{{$key}}</a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">List Product Order</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Name</th>
                                    <th width="30%">Unit Price</th>
                                    <th width="10%">Quantity</th>
                                    <th width="10%">Total</th>
                                    <th width="20%" colspan="2" class="text-center">Action</th>
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
                                        <td width="5%">
                                            <a href="">
                                                <button class="btn-link">Edit</button>
                                            </a>
                                        </td>
                                        <td width="5%">
                                            <form action="" method="post">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Do you want remove this product attribute?')" class="btn-link" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('order_footer_script')
    <script type="text/javascript">
        var URL = '{{route('order.change_status')}}'

        $(function () {
            $("#order_status").change(function () {
                var selected_status = $("#selected_status").val()
                var status1         = $("#order_status option:selected").val()
                console.log(selected_status)
                $.ajax({
                    url     : URL,
                    type    : 'GET',
                    data    : {
                        selected_status: selected_status,
                        status1        : status1
                    },
                    dataType: 'json',
                    success : function (data) {
                        console.log(data)
                    }

                })

                // var mysql = require('mysql');
                //
                // var con = mysql.createConnection({
                //     host: "localhost",
                //     user: "root",
                //     password: "Abc123@",
                //     database: "do_an"
                // });
                //
                // con.connect(function(err) {
                //     if (err) throw err;
                //     var sql = "UPDATE orders SET status = '3' WHERE address = '0'";
                //     con.query(sql, function (err, result) {
                //         if (err) throw err;
                //         console.log(result.affectedRows + " record(s) updated");
                //     });
                // });
                // con.end();

            })
        })
    </script>
@endsection
