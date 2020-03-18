@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Product information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="text-bold d-inline">Name:</p>
                                <p class="d-inline">{{$product->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="text-bold d-inline">Category:</p>
                                <p class="d-inline"><a class="text-dark text-decoration-none" href="{{route('category.index')}}">{{$product->category->name}}</a></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="text-bold d-inline">Price : </p>
                                <p class="d-inline">{{number_format($product->price)}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="mb-0">
                                    <span class="text-bold ">Description : </span><br>
                                    {{$product->description}}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="text-bold d-inline">Avatar : </p><br>
                                <p class="d-inline"><img style="block-size: 200px" src="/{{$product->product_images->first()->image_path}}" alt="Avatar"></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{route('product.index')}}" class="btn btn-primary">Back</a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('product.detail.edit', $product->id)}}" class="btn btn-primary">Update information </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Product Attributes</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Name</th>
                                    <th width="30%">Price</th>
                                    <th width="10%">Size</th>
                                    <th width="10%">Color</th>
                                    <th width="20%" colspan="2" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product_attributes as $key => $item)
                                    <tr>
                                        <td width="2%">{{++$key}}</td>
                                        <td width="40%">{{$item->sub_name}}</td>
                                        <td width="20%">$ {{number_format($item->sub_price)}}</td>
                                        <td width="10%">{{$item->size}}</td>
                                        <td width="5%" style="width: 30px; background-color: {{$item->color}}"></td>
                                        <td width="5%">
                                            <a href="{{route('product.product-attribute.edit', $item->id)}}">
                                                <button class="btn-link">Edit</button>
                                            </a>
                                        </td>
                                        <td width="5%">
                                            <form action="{{route('product-attribute.destroy', $item->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Do you want remove this product attribute?')" class="btn-link" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if(count($product_attributes) == 0)
                                <div class="text-center container-fluid">
                                    <p><i>There are no products to list</i></p>
                                </div>
                            @endif
                            <a class="btn btn-primary float-right" href="{{route('product.product-attribute.create')}}">Create new</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
