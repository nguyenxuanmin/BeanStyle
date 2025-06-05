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
                        <li class="breadcrumb-item"><a href="{{route('list_product')}}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$titlePage}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm" data-url-submit="{{route('save_product')}}" data-url-complete="{{route('list_product')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Mã sản phẩm</label>
                                    <input type="text" class="form-control" name="code" value="{{$productCode}}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="name" value="@if (isset($product)){{$product->name}}@endif">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mô tả ngắn</label>
                                    <textarea class="form-control" name="description" rows="4">@if (isset($product)){{$product->description}}@endif</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tình trạng</label>
                                    <input type="checkbox" class="form-check-input" name="status" @if (!isset($product) || (isset($product) && $product->status == 1)) checked @endif>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Đang sale</label>
                                    <input type="checkbox" class="form-check-input" name="isSale" @if ((isset($product) && $product->isSale == 1)) checked @endif>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Danh mục sản phẩm cấp 1</label>
                                    <select class="form-select" name="subCategory">
                                        @if (isset($subCategorys))
                                            @if (!isset($product) || (isset($product) && empty($product->sub_category_id)))
                                                <option selected disabled value="">Chọn danh mục sản phẩm cấp 1</option>
                                            @endif
                                            @foreach ($subCategorys as $item)
                                                <option @if (isset($product) && $item->id == $product->sub_category_id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                            <option selected disabled value="">Chọn danh mục sản phẩm cấp 1</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Thương hiệu</label>
                                    <select class="form-select" name="brand">
                                        @if (isset($brands))
                                            @if (!isset($product) || (isset($product) && empty($product->brand_id)))
                                                <option selected disabled value="">Chọn thương hiệu</option>
                                            @endif
                                            @foreach ($brands as $item)
                                                <option @if (isset($product) && $item->id == $product->brand_id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                            <option selected disabled value="">Chọn thương hiệu</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Mô tả sản phẩm</label>
                                <textarea name="content" id="contentSummernote">@if (isset($product)){{$product->content}}@endif</textarea>
                            </div>
                            <div class="col-12 mb-3 text-end">
                                @if ($action == 'add')
                                    <button class="btn btn-primary">Thêm</button>
                                @else
                                    <button class="btn btn-info">Cập nhật</button>
                                @endif
                                <a href="{{route('list_product')}}" class="btn btn-dark">Trở lại</a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="{{$action}}">
                    <input type="hidden" name="id" value="@if (isset($product)){{$product->id}}@endif">
                </form>
            </div>
        </div>
    </div>
@endsection
