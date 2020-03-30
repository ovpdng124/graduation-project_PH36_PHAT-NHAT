@extends('user.layouts.master')
@section('title', 'Homepage')
@section('content')
    @include('user.index.banner')
    <!--/ab -->
    <section class="about py-md-5 py-5">
        <div class="container-fluid">
            <div class="feature-grids row px-3">
                @include('user.index.category')
            </div>
        </div>
    </section>
    <!-- //ab -->

    <!--/products -->
    <section class="about py-5">
        <div class="container pb-lg-3">
            <h3 id="new-arrivals" class="tittle text-center">New Arrivals</h3>
            <div class="row">
                @foreach($new_arrivals as $product)
                    @if(!isset($product->is_new) || $product->is_new)
                        @component('user.index.products', ['product' => $product])
                        @endcomponent
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- //products -->

    <!--/testimonials-->
    <section class="testimonials py-5">
        <div class="container">
            <div class="test-info text-center">
                @include('user.index.testimonial')
            </div>
        </div>
    </section>
    <!--//testimonials-->

    <!--/popular-products -->
    <section class="about py-5">
        <div class="container pb-lg-3">
            <h3 class="tittle text-center">Popular Products</h3>
            <div class="row">
                    @component('user.index.popular', ['product' => $popular_products])
                    @endcomponent
            </div>
        </div>
    </section>
    <!-- //popular-products -->

    <!-- /branchs -->
    <section class="brands py-5" id="brands">
        <div class="container py-lg-0">
            <div class="row text-center brand-items">
                @include('user.index.branch')
            </div>
        </div>
    </section>
    <!-- //branchs -->
@endsection
