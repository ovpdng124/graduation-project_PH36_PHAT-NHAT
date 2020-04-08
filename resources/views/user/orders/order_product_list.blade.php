<div class="container-fluid">
    <h2 class="">Order Information: </h2>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <label for="" class="col-2 float-right">Name</label>
                <span>: {{$user->full_name}}</span>
            </div>
            <div class="row">
                <label for="" class="col-2">Address</label>
                <span>: {{$user->address}}</span>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <label for="" class="col-2">Phone</label>
                <span>: {{$user->phone_number}}</span>
            </div>
            <div class="row">
                <label for="" class="col-2">Email</label>
                <span>: {{$user->email}}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped">
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
    <div class="row">
        <div class="col-12">
            <p class="float-right">Total price: $ <span id="total-price">{{number_format($total_price)}}</span></p>
        </div>
        <div class="col-12">
            <p class="float-right">Discount price: $ <span id="discount-price">No discount</span></p>

        </div>
        <div class="col-12">
            <p class="float-right">Total payment: $ <span id="total-payment">{{number_format($total_price)}}</span></p>
        </div>
    </div>
    <div>
        <form action="{{route('order.create')}}" method="post" id="form-data">
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
                                <input type="text" id="voucher-code" class="form-control" name="voucher" placeholder="Enter discount code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="float-right btn btn-primary submit-order">Confirm Order</button>
        </form>
    </div>
</div>
<script src="{{mix('/js/orders/create.js')}}"></script>
