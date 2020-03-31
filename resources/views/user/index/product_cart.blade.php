@foreach($products as $key => $item)
    <tr>
        <td>{{++$key}}</td>
        <td>{{$item['sub_name']}}</td>
        <td><img style="width: 50px; height: 50px ; display: block;" src="{{$item['image_path']}}"></td>
        <td class="text-center"><span  style="width: 50px; height: 50px; border-radius: 50px; display: block; background-color:{{$item['color']}}"></span></td>
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
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
<script>
    $('.delete').click(function () {
        let cart      = JSON.parse(localStorage.getItem('cart'))
        let productId = $(this).data('product-id')
        let color     = $(this).data('color')
        let newCart   = {
            products: []
        }

        _.forEach(cart.products, function (product, key) {
            if (product.product_id === productId && product.color === color) {
                newCart.products = _.filter(cart.products, (n, k) => {
                    return k !== key
                })
            }
        })

        localStorage.setItem('cart', JSON.stringify(newCart))

        $('.table-body').html("")
        getProducts()
    })
</script>
