@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <form action="{{route('order.list')}}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{request()->query('search')}}">
                                <input type="hidden" name="searchBy" value="order_label">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-right">
                        {{$orders->onEachSide(1)->links()}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <h1 class="text-center">List Orders</h1>
                        <div class="row">
                            <table class="table-striped table">
                                <tr>
                                    <th>#</th>
                                    <th>Order Label</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                @foreach($orders as $key => $item)
                                    <tr>
                                        <td>{{$key + $orders->firstItem()}}</td>
                                        <td width="50%">{{$item['order_label']}}</td>
                                        <td width="20%">$ {{number_format($item['total_price'])}}</td>
                                        <td width="20%">
                                            <div class="btn-group">
                                                <span style="width: 100px" class="badge badge-pill badge-{!! $item->color_status !!}">{!! $item->name_status !!}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-info" href="{{route('order.detail', $item->id)}}">Detail</a>
                                                <a class="btn btn-info" href="{{route('order.edit', $item->id)}}">Edit</a>
                                                <form action="{{route('order.delete', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-info rounded-0" type="submit" onclick="confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if(count($orders) == 0)
                                <div class="text-center container-fluid">
                                    <p><i>No orders</i></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
