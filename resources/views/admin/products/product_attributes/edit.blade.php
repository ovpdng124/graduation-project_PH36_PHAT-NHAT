@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit product attribute</div>
                    <div class="card-body">
                        <div>
                            <a href="{{url()->previous()}}">
                                <button class="btn btn-primary">Back</button>
                            </a>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-9 well well-sm col-md-offset-4 container">
                                    <form action="{{route(strpos(url()->current(),'product/') ? 'product.product-attribute.update' : 'product-attribute.update', $product_attribute->id)}}" method="post"
                                          class="form" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Product: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <select name="product_id" class="form-control">
                                                    @foreach($products as $item)
                                                        <option value="{{$item->id}}" {{($product_attribute->product_id == $item->id) ? 'selected' : ''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Sub Name: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="sub_name" value="{{$product_attribute->sub_name}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('sub_name') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Sub Price: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="sub_price" value="{{$product_attribute->sub_price}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('sub_price') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Size: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="size" value="{{$product_attribute->size}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('size') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Color: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <select name="color" class="form-control">
                                                    @foreach($colors as $key => $item)
                                                        <option value="{{$item}}" {{$item == $product_attribute->color ? 'selected' : ''}}>{{$key}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->any())
                                                    @foreach($errors->get('color') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Thumbnail: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="file" name="thumbnails[]" class="form-control" multiple>
                                                @if($errors->any())
                                                    @foreach($errors->get('thumbnails.*') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages[0]}}</i>
                                                        @break
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-success btn-block col-md-5 container">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
