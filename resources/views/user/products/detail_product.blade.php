@extends('user.layouts.master')
@section('title','Product')

@section('custom_import')
    <link type="text/css" rel="stylesheet" href="{{asset("/template/css/lightslider.css") }}"/>
    <script src="{{mix("/js/slider/lightslider.js")}}"></script>
@endsection

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
                <div class="col-lg-12">
                    <div class="row">
                        <div class="desc1-left col-md-6">
                            <ul id="lightSlider" class="ulSlider">
                                @foreach($product->product_images as $item)
                                    <li class="liSlider" data-thumb="{{ asset($item->image_path)}}">
                                        <img style="block-size: 500px" src="{{ asset($item->image_path)}}" alt="No image"/>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="desc1-right col-md-6 pl-lg-4">
                            <h1 id="sub_name">{{$product->name}}</h1>
                            <h5 id="sub_price">${{number_format($product->price)}}</h5>
                            <div class="available mt-3">
                                @if(count($product->product_attributes) != 0)
                                    <button type="submit" class="btn btn-success btn-cart" data-product-id="{{$product->id}}">Add to cart</button>
                                @else
                                    <h2><i class="text-danger">Out of stock!!</i></h2>
                                @endif
                            </div>
                            <div class="available mt3 mt-3">
                                <form action="{{route('product-detail',$product->id)}}" method="get">
                                    <h3 class="">Color</h3>
                                    @foreach($product->product_attributes as $item)
                                        <label class="col-md-4 color" id="{{$item->id}}" data-sub-name="{{$item->sub_name}}" data-sub-price="{{number_format($item->sub_price)}}"
                                               data-label-color="{{$item->id}}" for="color-{{$item->color}}"
                                               style="width: 30px; height: 30px; border-radius: 10px; border: 2px gray solid; background-color:{{$item->color}}"></label>
                                        <input class="col-md-4" type="radio" hidden id="color-{{$item->color}}" value="{{ltrim($item->color, $item->color[0])}}" name="color" style="width: 20px">
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
                    <div class="sub-para-w3layouts mt-5">
                        <h3 class="shop-sing">{{$product->name}}</h3>
                        <p class="">{{$product->description}}</p>
                    </div>
                    <h3 class="shop-sing">Featured Products</h3>
                    <div class="row m-0">
                        @foreach($featuredProducts as $featuredProduct)
                            <div class="col-md-4 product-men">
                                <div class="product-shoe-info shoe text-center">
                                    <div class="men-thumb-item">
                                        <a href="{{route('product-detail', $featuredProduct->id)}}"><img style="block-size: 300px" src="{{asset($featuredProduct->product_images->first()->image_path)}}" class="img-fluid"
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

@section('custom_footer_script')
    <script src="{{mix("/js/detail_product/detail_product.js")}}"></script>
@endsection
