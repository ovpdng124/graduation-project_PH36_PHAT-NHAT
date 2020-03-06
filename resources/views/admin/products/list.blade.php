@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="hidden" name="searchBy" value="code">
                                <input type="text" class="form-control" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i></button>
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
                            <table class="table-striped table">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th class="text-center" colspan="2">Action</th>
                                </tr>
                                @foreach($products as $key => $item)
                                    <tr>
                                        <td width="2%">{{$key + $products->firstItem()}}</td>
                                        <td width="20%">{{$item->name}}</td>
                                        <td width="50%">{{$item->description}}</td>
                                        <td width="10%">$ {{number_format($item->price)}}</td>
                                        <td width="20%">{{$item->category->name}}</td>
                                        <td width="10%">
                                            <a href="{{route('product.edit', $item->id)}}"><button class="btn-link">Edit</button></a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection