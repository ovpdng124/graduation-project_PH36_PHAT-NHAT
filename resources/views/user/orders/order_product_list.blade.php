<div class="container-fluid">
    <hr>
    <h4 class="">Information: </h4><br>
    <div class="row font-weight-bold">
        <div class="col-lg-6">
            <div>
                <label for="">Name : {{$user->full_name}}</label>
            </div>
            <div>
                <label for="">Address : {{$user->address}}</label>
            </div>
        </div>
        <div class="col-lg-6">
            <div>
                <label for="">Phone : {{$user->phone_number}}</label>
            </div>
            <div>
                <label for="">Email : {{$user->email}}</label>
            </div>
        </div>
    </div>
    <hr>

    <h4 class="">Products: </h4><br>
    <div class="row">
        <table class="table table-striped table-responsive-sm">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Images</th>
                <th>Color</th>
                <th>Size</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            <tbody class="table-body">
            @foreach($products as $key => $item)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item->sub_name}}</td>
                    <td><img style="width: 50px; height: 50px ; display: block;" src="{{$item->image_path}}"></td>
                    <td class="text-center"><span style="width: 50px; height: 50px; border-radius: 50px; display: block; background-color:{{$item['color']}}"></span></td>
                    <td>{{$item->size}}</td>
                    <td>$ {{number_format($item->sub_price)}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>$ {{number_format($item->total_price)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="row font-weight-bold">
        <div class="col-12">
            <p style="color: black; font-size: 110%" class="float-right">Total price: $ <span id="totalPrice">{{number_format($total_price)}}</span></p>
        </div>
        <div class="col-12">
            <p style="color: black; font-size: 110%" class="float-right">Discount price: $ <span id="discountPrice">No discount</span></p>

        </div>
        <div class="col-12">
            <p style="color: black; font-size: 110%" class="float-right">Total payment: $ <span id="totalPayment">{{number_format($total_price)}}</span></p>
        </div>
    </div>
    <div>
        <form action="{{route('order.create')}}" method="post" id="formData">
            @csrf
            <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}">
            <input type="hidden" class="form-control" name="method_type" value="1">
            <input type="hidden" class="form-control" name="total_quantity" value="{{$total_quantity}}">
            <input type="hidden" class="form-control total-payment" name="total_price" value="{{$total_price}}">
            <input type="hidden" class="form-control is-sale" name="is_sale" value="0">
            <input type="hidden" class="form-control discount-price" name="sale_price" value="">
            <input type="hidden" class="form-control voucher" name="voucher_id" value="">
            @foreach($products as $key => $item)
                <input type="hidden" class="form-control" name="products[{{$key}}][sub_name]" value="{{$item->sub_name}}">
                <input type="hidden" class="form-control" name="products[{{$key}}][sub_price]" value="{{$item->sub_price}}">
                <input type="hidden" class="form-control" name="products[{{$key}}][quantity]" value="{{$item->quantity}}">
            @endforeach
            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <div class="float-right">
                            <button type="button" style="width: 100%" class="btn btn-secondary" data-toggle="collapse" data-target="#voucher">Did you have discount code?</button>
                            <div id="voucher" class="collapse">
                                <input type="text" id="voucherCode" class="form-control" name="voucher" placeholder="Enter discount code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="float-right btn btn-primary submit-order">Submit</button>
        </form>
    </div>
</div>
<script src="{{mix('/js/orders/create.js')}}"></script>

