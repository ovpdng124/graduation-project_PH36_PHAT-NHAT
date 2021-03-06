@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid row justify-content-center">
            <div class="card container-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <form action="{{route('category.index')}}" method="get">
                            <div class="input-group">
                                <input type="hidden" name="searchBy" value="name">
                                <input type="text" class="form-control" name="search" value="{{request()->query('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-left ml-3">
                        <a href="{{route('category.create')}}" class="btn btn-info float-right mb-1">
                            <i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block">Create new</span>
                        </a>
                    </div>
                    <div class="float-right">
                        {{$categories->onEachSide(1)->links()}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <h1 class="text-center">List Categories</h1>
                        <div class="row">
                            <table class="table-striped table table-responsive">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                @foreach($categories as $key => $item)
                                    <tr>
                                        <td width="2%">{{$key + $categories->firstItem()}}</td>
                                        <td width="78%">{{$item->name}}</td>
                                        <td width="20%" class="text-center">
                                            <div class="btn-group">
                                                <a class="btn btn-info" href="{{route('category.show', $item->id)}}">Detail</a>
                                                <a class="btn btn-warning" href="{{route('category.edit', $item->id)}}">Edit</a>
                                                <form action="{{route('category.destroy', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger rounded-0" type="submit" onclick="return confirm('Do you want remove this category?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if(count($categories) == 0)
                                <div class="text-center container-fluid">
                                    <p><i>No categories</i></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
