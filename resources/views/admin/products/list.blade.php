@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <form action="{{route('product.index')}}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{request()->query('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="name" value="name" {{request()->query('searchBy') == 'name' ? 'checked' : ''}}>
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="description" value="description" {{request()->query('searchBy') == 'description' ? 'checked' : ''}}>
                                    <label for="description">Description</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="price" value="price" {{request()->query('searchBy') == 'price' ? 'checked' : ''}}>
                                    <label for="price">Price</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="category" value="category" {{request()->query('searchBy') == 'category' ? 'checked' : ''}}>
                                    <label for="category">Category</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-left ml-3">
                        <a href="{{route('product.create')}}" class="btn btn-info float-right mb-1">
                            <i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block">Create new</span>
                        </a>
                    </div>
                    <div class="float-right">
                        {{$products->onEachSide(1)->links()}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <h1 class="text-center">List Products</h1>
                        <div class="row">
                            <table class="table-striped table table-responsive">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center" colspan="3">Action</th>
                                </tr>
                                @foreach($products as $key => $item)
                                    <tr>
                                        <td width="2%">{{$key + $products->firstItem()}}</td>
                                        <td width="70%">{{$item->name}}</td>
                                        <td width="20%"><img src="{{asset($item->product_images->first()->image_path)}}" width="150" height="150"></td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-info" href="{{route('product.show', $item->id)}}">Detail</a>
                                                <a class="btn btn-warning" href="{{route('product.edit',$item->id)}}">Edit</a>
                                                <form action="{{route('product.destroy', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger rounded-0" type="submit" onclick="return confirm('Do you want remove this product?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if(count($products) == 0)
                                <div class="text-center container-fluid">
                                    <p><i>There are no products to list</i></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
