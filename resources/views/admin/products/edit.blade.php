@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit product</div>
                    <div class="card-body">
                        <div>
                            <a href="{{url()->previous()}}">
                                <button class="btn btn-primary">Back</button>
                            </a>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-9 well well-sm col-md-offset-4 container">
                                    <form action="{{route(strpos(url()->current(),'detail')? 'product.detail.update' : 'product.update', $product->id)}}" enctype="multipart/form-data" method="post"
                                          class="form" role="form">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Name: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="name" value="{{$product->name}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('name') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Price: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="price" value="{{$product->price}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('price') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Category: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <select name="category_id" class="form-control">
                                                    @foreach($categories as $item)
                                                        <option {{$product->category_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Avatar: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="file" class="form-control" name="avatar">
                                                @if($errors->any())
                                                    @foreach($errors->get('avatar') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Description: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <textarea class="form-control" name="description" id="" cols="30" rows="10">{{$product->description}}</textarea>
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
