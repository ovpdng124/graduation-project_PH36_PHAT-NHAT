@extends('user.layouts.master')
@section('title','Product')

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;" id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Shop Single</li>
    </ol>
    <!---->
    <!-- banner -->
    <section class="ab-info-main py-md-5 py-4">
        <div class="container py-md-3">
            <!-- top Products -->
            <div class="row">
                <!-- product left -->
                <div class="side-bar col-lg-4">
                    <div class="search-bar w3layouts-newsletter">
                        <h3 class="sear-head">Search Here..</h3>
                        <form action="#" method="post" class="d-flex">
                            <input type="search" placeholder="Product name..." name="search" class="form-control" required="">
                            <button class="btn1"><span class="fa fa-search" aria-hidden="true"></span></button>
                        </form>
                    </div>
                    <!--preference -->
                    <div class="left-side my-4">
                        <h3 class="sear-head">Occasion</h3>
                        <ul class="w3layouts-box-list">
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">Casuals</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">Party</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">Wedding</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">Ethnic</span>
                            </li>
                        </ul>
                    </div>
                    <!-- // preference -->
                    <!-- discounts -->
                    <div class="left-side">
                        <h3 class="sear-head">Discount</h3>
                        <ul class="w3layouts-box-list">
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">5% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">10% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">20% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">30% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">50% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">60% or More</span>
                            </li>
                        </ul>
                    </div>
                    <!-- //discounts -->
                    <!-- reviews -->
                    <div class="customer-rev left-side my-4">
                        <h3 class="sear-head">Customer Review</h3>
                        <ul class="w3layouts-box-list">
                            <li>
                                <a href="#">
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span>5.0</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                    <span>4.0</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star-half-o" aria-hidden="true"></span>
                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                    <span>3.5</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                    <span>3.0</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    <span class="fa fa-star-half-o" aria-hidden="true"></span>
                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                    <span>2.5</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- //reviews -->
                    <!-- deals -->
                    <div class="deal-leftmk left-side">
                        <h3 class="sear-head">Special Deals</h3>
                        <div class="special-sec1 row mb-3">
                            <div class="img-deals col-md-4">
                                <img src="images/s4.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="img-deal1 col-md-4">
                                <h3>Shuberry Heels</h3>
                                <a href="shop-single.html">$180.00</a>
                            </div>
                        </div>
                        <div class="special-sec1 row">
                            <div class="img-deals col-md-4">
                                <img src="images/s2.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="img-deal1 col-md-8">
                                <h3>Chikku Loafers</h3>
                                <a href="shop-single.html">$99.00</a>
                            </div>
                        </div>
                        <div class="special-sec1 row my-3">
                            <div class="img-deals col-md-4">
                                <img src="images/s1.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="img-deal1 col-md-8">
                                <h3>Bella Toes</h3>
                                <a href="shop-single.html">$165.00</a>
                            </div>
                        </div>
                        <div class="special-sec1 row">
                            <div class="img-deals col-md-4">
                                <img src="images/s5.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="img-deal1 col-md-8">
                                <h3>Red Bellies</h3>
                                <a href="shop-single.html">$225.00</a>
                            </div>
                        </div>
                        <div class="special-sec1 row mt-3">
                            <div class="img-deals col-md-4">
                                <img src="images/s3.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="img-deal1 col-md-8">
                                <h3>(SRV) Sneakers</h3>
                                <a href="shop-single.html">$169.00</a>
                            </div>
                        </div>
                    </div>
                    <!-- //deals -->

                </div>
                <!-- //product left -->
                <!-- product right -->
                <div class="left-ads-display col-lg-8">
                    <div class="row">
                        <div class="desc1-left col-md-6">
                            <ul id="lightSlider" class="ulSlider">
                                @foreach($product->product_images as $item)
                                    <li class="liSlider" data-thumb="{{ asset($item->image_path)}}">
                                        <img src="{{ asset($item->image_path)}}"/>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="desc1-right col-md-6 pl-lg-4">
                            <h3>{{$product->name}}</h3>
                            <h5>${{number_format($product->price)}}</h5>
                            <div class="available mt-3">
                                <button type="submit" class="btn btn-success btn-cart" data-product-id="{{$product->id}}">Add to cart</button>
                                <p>Lorem Ipsum has been the industry's standard since the 1500s. Praesent ullamcorper dui turpis.. </p>
                            </div>
                            <div class="available mt3">
                                <form action="{{route('product-detail',$product->id)}}" method="get">
                                    <h3 class="">Color</h3>
                                    @foreach($product->product_attributes as $item)
                                        <label class="col-md-4" for="color-{{$item->color}}" style="width: 30px; height: 30px; background-color:{{$item->color}}"></label>
                                        <input class="col-md-4 color-change" type="radio" id="color-{{$item->color}}" value="{{ltrim($item->color, $item->color[0])}}" name="color" style="width: 20px">
                                    @endforeach
                                </form>
                            </div>
                            <div class="share-desc">
                                <div class="share">
                                    <h4>Share Product :</h4>
                                    <ul class="w3layouts_social_list list-unstyled">
                                        <li>
                                            <a href="#" class="w3pvt_facebook">
                                                <span class="fa fa-facebook-f"></span>
                                            </a>
                                        </li>
                                        <li class="mx-2">
                                            <a href="#" class="w3pvt_twitter">
                                                <span class="fa fa-twitter"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="w3pvt_dribble">
                                                <span class="fa fa-dribbble"></span>
                                            </a>
                                        </li>
                                        <li class="ml-2">
                                            <a href="#" class="w3pvt_google">
                                                <span class="fa fa-google-plus"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row sub-para-w3layouts mt-5">
                        <h3 class="shop-sing">{{$product->name}}</h3>
                        <p class="mt-3">{{$product->description}}</p>
                    </div>
                    <h3 class="shop-sing">Featured Products</h3>
                    <div class="row m-0">
                        @foreach($featuredProducts as $featuredProduct)
                            <div class="col-md-4 product-men">
                                <div class="product-shoe-info shoe text-center">
                                    <div class="men-thumb-item">
                                        <a href="{{route('product-detail', $featuredProduct->id)}}"><img src="{{asset($featuredProduct->product_images->first()->image_path)}}" class="img-fluid"
                                                                                                         alt=""></a>
                                    </div>
                                    <div class="item-info-product">
                                        <h4>
                                            <a href="{{route('product-detail', $featuredProduct->id)}}">{{$featuredProduct->name}}</a>
                                        </h4>
                                        <div class="product_price">
                                            <div class="grid-price">
                                                <span class="money">${{number_format($featuredProduct->price)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom_import')
    <link type="text/css" rel="stylesheet" href="{{asset("/template/css/lightslider.css") }}"/>
    <script src="{{mix("/js/lightslider.js")}}"></script>
@endsection
@section('custom_footer_script')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#lightSlider").lightSlider({
                gallery    : true,
                item       : 1,
                loop       : true,
                slideMargin: 0,
                thumbItem  : 9
            })
        })

        $(".btn-cart").click((function () {
            let cart  = localStorage.getItem('cart')
            let color = $("input[name='color']:checked").val()

            if (cart == null) {
                cart = {
                    "products": []
                }
            } else {
                cart = JSON.parse(cart)
            }
            if (color != null) {
                let productId  = $(this).data('product-id')
                let checkExist = false

                //check Quantity
                _.forEach(cart.products, function (product) {
                    if (product.product_id === productId && product.color === color) {
                        product.quantity = product.quantity + 1
                        product.color    = color

                        checkExist = true
                    }
                })

                if (!checkExist) {
                    let product = {
                        product_id: productId,
                        quantity  : 1,
                        color     : color
                    }
                    cart.products.push(product)
                }

                localStorage.setItem('cart', JSON.stringify(cart))

            } else {
                alert("Please choose color")
            }
        }))
    </script>
@endsection

