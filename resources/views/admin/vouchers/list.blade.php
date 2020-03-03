@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container">
                <div class="card-header">
                    <div class="card-title">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="hidden" name="searchBy" value="code">
                                <input type="text" class="form-control" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i>
                                    </button>
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
                            <table class="table-striped table">
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Value</th>
                                    <th>Unit</th>
                                    <th class="text-center" colspan="2">Action</th>
                                </tr>
                                @foreach($vouchers as $key => $item)
                                    <tr>
                                        <td width="10%">{{$key + $vouchers->firstItem()}}</td>
                                        <td width="40%">{{$item->code}}</td>
                                        <td width="20%">{{$item->value}}</td>
                                        <td width="20%">{{$item->unit}}</td>
                                        <td width="10%">
                                            <a href="{{route('voucher.edit', $item->id)}}">
                                                <button class="btn-link">Edit</button>
                                            </a>
                                        </td>
                                        <td width="10%">
                                            <form action="{{route('voucher.destroy', $item->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Do you want remove this code?')" class="btn-link" type="submit">Delete</button>
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
