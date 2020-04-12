<div class="col-md-6 latest-left">
    <div class="product-shoe-info shoe text-center">
        <a href="{{route('product-detail',$product['product1'])}}"><img style="height: 564px; width: 508px" src="{{!empty($product) ? asset($product['image1']) : ''}}" class="img-fluid" alt=""></a>
    </div>
</div>
<div class="col-md-6 latest-right">
    <div class="row latest-grids">
        <div class="latest-grid1 product-men col-12">
            <div class="product-shoe-info shoe text-center">
                <div class="men-thumb-item">
                    <a href="{{route('product-detail',$product['product2'])}}"><img style="height: 254px; width: 508px" src="{{!empty($product) ? asset($product['image2']) : ''}}" class="img-fluid" alt=""></a>
                </div>
            </div>
        </div>
        <div class="latest-grid2 product-men col-12 mt-lg-4">
            <div class="product-shoe-info shoe text-center">
                <div class="men-thumb-item">
                    <a href="{{route('product-detail',$product['product3'])}}"><img style="height: 254px; width: 508px" src="{{!empty($product) ? asset($product['image3']) : ''}}" class="img-fluid" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
