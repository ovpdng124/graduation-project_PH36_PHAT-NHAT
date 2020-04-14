@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="float-left ml-3">
                            <a href="{{url()->previous()}}" class="btn btn-info float-right"><i class="fa fa-arrow-left mr-1"></i>Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <h1 class="text-center mb-4">Update Discount</h1>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-7 well well-sm col-md-offset-4 container">
                                    <form action="{{route('order.update', $order->id)}}" method="post" class="form" role="form">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Total Price: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <span hidden id="totalPrice">{{number_format($order->total_price)}}</span>
                                                <h5 class="mt-2">$ <span id="totalPayment">{{number_format($order->total_price)}}</span></h5>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Discount Price: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <h5 class="mt-2">$ <span id="discountPrice">{{($order->is_sale) ? number_format($order->sale_price) : 'No discount'}}</span></h5>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Voucher Code: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input {{($order->is_sale) ? 'readonly' : ''}} type="text" id="voucherCode" class="form-control" name="voucher" placeholder="Enter discount code"
                                                       value="{{($order->is_sale) ? $order->voucher->code : ''}}">
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control total-payment" name="total_price" value="{{$order->total_price}}">
                                        <input type="hidden" class="form-control is-sale" name="is_sale" value="0">
                                        <input type="hidden" class="form-control discount-price" name="sale_price" value="">
                                        <input type="hidden" class="form-control voucher" name="voucher_id" value="">
                                        @if($order->is_sale)
                                            <a type="button"
                                               class="btn btn-lg btn-secondary btn-block col-md-5 container" href="{{url()->previous()}}"> Back
                                            </a>
                                        @else
                                            <button type="submit"
                                                    class="btn btn-lg btn-primary btn-block col-md-5 container"> Update
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{mix('/js/orders/check_voucher.js')}}"></script>
@endsection
