@extends('admin.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{$titlePage}}</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('list_sub_category')}}">Danh mục sản phẩm cấp 1</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$titlePage}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm" data-url-submit="{{route('save_sub_category')}}" data-url-complete="{{route('list_sub_category')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên danh mục sản phẩm cấp 1</label>
                                    <input type="text" class="form-control" name="name" value="@if (isset($subCategory)){{$subCategory->name}}@endif">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Danh mục sản phẩm</label>
                                    <select class="form-select" name="category">
                                        @if (isset($categories))
                                            @if (!isset($subCategory))
                                                <option selected disabled value="">Chọn danh mục sản phẩm</option>
                                            @endif
                                            @foreach ($categories as $item)
                                                <option @if (isset($subCategory) && $item->id == $subCategory->category_id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                            <option selected disabled value="">Chọn danh mục sản phẩm</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3 text-end">
                                @if ($action == 'add')
                                    <button class="btn btn-primary">Thêm</button>
                                @else
                                    <button class="btn btn-info">Cập nhật</button>
                                @endif
                                <a href="{{route('list_sub_category')}}" class="btn btn-dark">Trở lại</a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="{{$action}}">
                    <input type="hidden" name="id" value="@if (isset($subCategory)){{$subCategory->id}}@endif">
                </form>
            </div>
        </div>
    </div>
@endsection
