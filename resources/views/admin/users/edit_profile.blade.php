@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="float-left ml-3">
                            <a href="{{url()->previous()}}" class="btn btn-info float-right"><i class="fa fa-arrow-left mr-1"></i>Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <h1 class="text-center mb-4">Information</h1>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-7 well well-sm col-md-offset-4 container">
                                    <form action="{{route('admin.edit.profile')}}" method="post" class="form" role="form">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="id" value="{{$userProfile->id}}">
                                        <div class="row form-group">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Name: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="full_name" value="{{$userProfile->full_name}}" autofocus>
                                                @if($errors->any())
                                                    @foreach($errors->get('full_name') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Email: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="email" class="form-control" name="email" value="{{$userProfile->email}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('email') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Address: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="address" value="{{$userProfile->address}}" autofocus>
                                                @if($errors->any())
                                                    @foreach($errors->get('address') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Phone: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="phone_number" value="{{$userProfile->phone_number}}" autofocus>
                                                @if($errors->any())
                                                    @foreach($errors->get('phone_number') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-primary btn-block col-md-5 container"> Update</button>
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
