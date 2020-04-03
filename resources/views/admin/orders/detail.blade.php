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
                                </p>
                                <div class="dropdown">
                                    <button class="bg bg-{!! $order->color_status !!} dropdown-toggle rounded-pill" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <span href="">{!! $order->name_status !!}</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach($orders as $key => $value)
                                            <a class="dropdown-item bg bg-{!! \App\Entities\Order::$statusColor[$value] !!} rounded-pill" href="{{route('order.updateStatus',[$order->id,$value] )}}">{{$key}}</a>
                                        @endforeach
                                    </div>
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
