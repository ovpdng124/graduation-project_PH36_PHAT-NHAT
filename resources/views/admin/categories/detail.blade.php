@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Category information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <p class="text-bold d-inline">Name:</p>
                                <p class="d-inline">{{$category->name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{route('category.index')}}" class="btn btn-primary">Back</a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('category.detail.edit', $category->id)}}" class="btn btn-primary">Update information </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Products</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center" colspan="3">Action</th>
                                    </tr>
                                    @foreach($products as $key => $item)
                                        <tr>
                                            <td width="2%">{{++$key}}</td>
                                            <td width="70%">{{$item->name}}</td>
                                            <td width="20%"><img src="/{{$item->product_images->first()->image_path}}" width="150" height="150"></td>
                                            <td width="10%">
                                                <a href="{{route('product.show', $item->id)}}">
                                                    <button class="btn-link">Details</button>
                                                </a>
                                            </td>
                                            <td width="10%">
                                                <form action="{{route('product.destroy', $item->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button onclick="return confirm('Do you want remove this product?')" class="btn-link" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                @if(count($products) == 0)
                                    <div class="text-center container-fluid">
                                        <p><i>There are no products to list</i></p>
                                    </div>
                                @endif
                                <a class="btn btn-primary float-right" href="{{route('category.product.create')}}">Create new</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
