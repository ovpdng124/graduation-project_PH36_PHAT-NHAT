@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit voucher</div>
                    <div class="card-body">
                        <div>
                            <a href="{{url()->previous()}}">
                                <button class="btn btn-primary">Back</button>
                            </a>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-9 well well-sm col-md-offset-4 container">
                                    <form action="{{route('voucher.update', $voucher->id)}}" method="post" class="form" role="form">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Code: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="code"
                                                       value="{{$voucher->code}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('code') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Value: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="number" class="form-control" name="value"
                                                       value="{{$voucher->value}}">
                                                @if($errors->any())
                                                    @foreach($errors->get('value') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Unit: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <div class="">
                                                    <input type="radio" id="%" name="unit"
                                                           value="%" {{$voucher->unit == '%' ? 'checked' : ''}}>
                                                    <label for="%">Percent (%)</label>
                                                </div>
                                                <div class="">
                                                    <input type="radio" id="-" name="unit"
                                                           value="-" {{$voucher->unit == '-' ? 'checked' : ''}}>
                                                    <label for="-">Minus (-)</label>
                                                </div>
                                                @if($errors->any())
                                                    @foreach($errors->get('unit') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
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
