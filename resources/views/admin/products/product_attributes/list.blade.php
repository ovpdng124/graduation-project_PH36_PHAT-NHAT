@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <form action="{{route('product-attribute.index')}}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{request()->query('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="name" value="sub_name" {{request()->query('searchBy') == 'sub_name' ? 'checked' : ''}}>
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="size" value="size" {{request()->query('searchBy') == 'size' ? 'checked' : ''}}>
                                    <label for="size">Size</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="price" value="sub_price" {{request()->query('searchBy') == 'sub_price' ? 'checked' : ''}}>
                                    <label for="price">Price</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-left ml-3">
                        <a href="{{route('product-attribute.create')}}" class="btn btn-info float-right mb-1">
                            <i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block">Create new</span>
                        </a>
                    </div>
                    <div class="float-right">
                        {{$productAttributes->onEachSide(1)->links()}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <h1 class="text-center">List Product Attributes</h1>
                        <div class="row">
                            <table class="table-striped table">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                @foreach($productAttributes as $key => $item)
                                    <tr>
                                        <td width="2%">{{$key + $productAttributes->firstItem()}}</td>
                                        <td width="40%">{{$item->sub_name}}</td>
                                        <td width="20%">$ {{number_format($item->sub_price)}}</td>
                                        <td width="10%">{{$item->size}}</td>
                                        <td width="5%" style="border-radius: 50px; background-color: {{$item->color}}"></td>
                                        <td width="23%" class="text-center">
                                            <div class="btn-group">
                                                <a class="btn btn-warning" href="{{route('product-attribute.edit', $item->id)}}">Edit</a>
                                                <form action="{{route('product-attribute.destroy', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger rounded-0" type="submit" onclick="return confirm('Do you want remove this product attribute?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if(count($productAttributes) == 0)
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
