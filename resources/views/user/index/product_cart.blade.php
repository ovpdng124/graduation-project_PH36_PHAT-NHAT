@foreach($products as $key => $item)
    <tr>
        <td>{{++$key}}</td>
        <td>{{$item['sub_name']}}</td>
        <td><img style="width: 50px; height: 50px ; display: block;" src="{{$item['image_path']}}"></td>
        <td class="text-center"><span style="width: 50px; height: 50px; border-radius: 50px; display: block; background-color:{{$item['color']}}"></span></td>
        <td>{{$item['size']}}</td>
        <td>$ {{number_format($item['sub_price'])}}</td>
        <td>{{$item['quantity']}}</td>
        <td>$ {{number_format($item['total_price'])}}</td>
        <td class="text-center">
            <button class="btn btn-lg btn-danger delete" type="button" data-product-id="{{$item['product_id']}}" data-color="{{ltrim($item['color'], $item['color'][0])}}">X
            </button>
        </td>
    </tr>
@endforeach

<td colspan="8"><span class="float-right mr-5"><b style="font-size: 120%">Total: $ {{number_format($total)}}</b></span></td>
<td>
    <button class="container btn btn-success">Order</button>
</td>
<script src="{{mix('/js/product_cart/product_cart.js')}}"></script>

