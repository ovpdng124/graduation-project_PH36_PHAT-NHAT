<div class="col-md-4 product-men">
    <div class="product-shoe-info shoe text-center">
        <div class="men-thumb-item">
            @foreach($product->product_images as $image)
                <a href="#"><img style="block-size: 300px" src="/{{$image->image_path}}" class="img-fluid" alt=""></a>
            @endforeach
            <span class="product-new-top">New</span>
        </div>
        <div class="item-info-product">
            <h4>
                <a href="#">{{$product->name}}</a>
            </h4>
            <div class="product_price">
                <div class="grid-price">
                    <span class="money">$ {{number_format($product->price)}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
