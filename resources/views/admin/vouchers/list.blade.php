@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <form action="{{route('voucher.index')}}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{request()->query('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="code" value="code" {{request()->query('searchBy') == 'code' ? 'checked' : ''}}>
                                    <label for="code">Code</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="value" value="value" {{request()->query('searchBy') == 'value' ? 'checked' : ''}}>
                                    <label for="value">Value</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" name="searchBy" id="unit" value="unit" {{request()->query('searchBy') == 'unit' ? 'checked' : ''}}>
                                    <label for="unit">Unit</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-left ml-3">
                        <a href="{{route('voucher.create')}}" class="btn btn-info float-right mb-1">
                            <i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block">Create new</span>
                        </a>
                    </div>
                    <div class="float-right">
                        {{$vouchers->onEachSide(1)->links()}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <h1 class="text-center">List Vouchers</h1>
                        <div class="row">
                            <table class="table-striped table table-responsive">
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Value</th>
                                    <th>Unit</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                @foreach($vouchers as $key => $item)
                                    <tr>
                                        <td width="10%">{{$key + $vouchers->firstItem()}}</td>
                                        <td width="40%">{{$item->code}}</td>
                                        <td width="20%">{{$item->value}}</td>
                                        <td width="20%">{{$item->unit}}</td>
                                        <td width="20%">
                                            <div class="btn-group">
                                                <a class="btn btn-warning" href="{{route('voucher.edit', $item->id)}}">Edit</a>
                                                <form action="{{route('voucher.destroy',  $item->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button onclick="return confirm('Do you want remove this voucher?')" class="btn btn-info rounded-0 btn-danger" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if(count($vouchers) == 0)
                                <div class="text-center container-fluid">
                                    <p><i>No vouchers</i></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
