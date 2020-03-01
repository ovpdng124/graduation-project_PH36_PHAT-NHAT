@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit user</div>
                    <div class="card-body">
                        <div>
                            <a href="{{url()->previous()}}">
                                <button class="btn btn-primary">Back</button>
                            </a>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-9 well well-sm col-md-offset-4 container">
                                    <form action="{{route('user.edit', $user->id)}}" method="post" class="form"
                                          role="form">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Full Name: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="full_name"
                                                       value="{{$user->full_name}}">
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
                                                <input type="text" class="form-control" name="email"
                                                       value="{{$user->email}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('email') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Address: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="address"
                                                       value="{{$user->address}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('address') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Phone: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="tel" class="form-control" name="phone_number"
                                                       value="{{$user->phone_number}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('phone_number') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit"
                                                class="btn btn-lg btn-primary btn-block col-md-5 container"> Update
                                        </button>
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
