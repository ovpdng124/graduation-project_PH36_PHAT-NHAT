@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create a new voucher</div>
                    <div class="card-body">
                        <div>
                            <a href="{{url()->previous()}}">
                                <button class="btn btn-primary">Back</button>
                            </a>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-9 well well-sm col-md-offset-4 container">
                                    <form action="{{route('voucher.store')}}" method="post" class="form"
                                          role="form">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-xs-3 col-md-3">
                                                <label for="" class="float-md-right mt-2">Code: </label>
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                                                <input type="text" class="form-control" name="code"
                                                       value="{{old('code')}}">
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
                                                       value="{{old('value')}}">
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
                                                           value="%" checked>
                                                    <label for="%">Percent (%)</label>
                                                </div>
                                                <div class="">
                                                    <input type="radio" id="-" name="unit"
                                                           value="-">
                                                    <label for="-">Division (-)</label>
                                                </div>
                                                @if($errors->any())
                                                    @foreach($errors->get('unit') as $messages)
                                                        <i style="color: red; font-size: 90%; font-family: sans-serif">*{{$messages}}</i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit"
                                                class="btn btn-lg btn-success btn-block col-md-5 container"> Create
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
