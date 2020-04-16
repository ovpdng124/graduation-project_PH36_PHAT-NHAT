@extends('user.layouts.master')
@section('title','Shopping')
<script src="{{mix('js/app.js')}}"></script>
@section('custom_import')

@endsection

@section('content')
    <div class="main-banner inner" style="background: url({{asset('template/images/banner.jpg')}})no-repeat center;" id="home"></div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Shop</li>
    </ol>
    <section class="ab-info-main py-md-5 py-4">
        <div class="container py-md-3">
            <!-- top Products -->
            <div class="row">
                <!-- product left -->
                <div class="side-bar col-lg-4">
                    <!--preference -->
                    <div class="left-side my-4">
                        <button type="button" style="width: 100%" class="btn btn-link" data-toggle="collapse" data-target="#categories"><h3 class="float-left sear-head">CATEGORY</h3></button>
                        <div id="categories" class="collapse show">
                            <ul class="list-group list-group-flush">
                                <a class="list-group-item" href="{{route('shopping')}}">
                                    <li>
                                        <span class="text-dark">All</span>
                                    </li>
                                </a>
                                @foreach($categories as $item)
                                    <a class="list-group-item" href="{{url()->current().'?category='. $item->name}}">
                                        <li>
                                            <span class="text-dark">{{$item->name}}</span>
                                        </li>
                                    </a>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <!-- // preference -->
                </div>
                <!-- //product left -->
                <!-- product right -->
                <div class="left-ads-display col-lg-8">
                    <div class="row shopping-products">
                        @if(count($products) === 0)
                            <div class="container">
                                <p class="text-center">No products</p>
                            </div>
                        @endif
                        @foreach($products as $item)
                            <div class="col-md-4 product-men">
                                <div class="product-shoe-info shoe text-center">
                                    <div class="men-thumb-item">
                                        <a href="{{route('product-detail', $item->id)}}"><img style="block-size: 200px" src="{{asset($item->product_images->first()->image_path)}}" class="img-fluid"
                                                                                              alt=""></a>
                                        <span class="product-new-top" {{$item->is_new ? '' : 'hidden'}}>New</span>
                                    </div>
                                    <div class="item-info-product">
                                        <h4>
                                            <a href="{{route('product-detail', $item->id)}}">{{$item->name}}</a>
                                        </h4>

                                        <div class="product_price">
                                            <div class="grid-price">
                                                <span class="money">{{number_format($item->price)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="float-right">
                        {{$products->onEachSide(1)->links()}}
                    </div>
                    <div class="grid-img-right mt-5 text-right">
                        <span class="money">Flat 50% Off</span>
                        <a href="{{route('shopping')}}" class="btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom_footer_script')

@endsection
