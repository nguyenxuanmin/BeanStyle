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
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mã sản phẩm</label>
                                <input type="text" class="form-control" name="code" value="{{$product->product_code}}" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="name" value="{{$product->name}}" readonly>
                            </div>
                            @if (count($productSizes))
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Bảng kích thước của sản phẩm</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Tên kích thước</th>
                                                    <th>Giá sản phẩm</th>
                                                    <th style="width: 200px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($productSizes as $item)
                                                    <tr class="align-middle">
                                                        <td>@if(empty($item->size)) Freesize @else{{$item->size->name}}@endif</td>
                                                        <td>{{number_format($item->price, 0, ',', '.')}} VND</td>
                                                        <td style="text-align: right;">
                                                            <button class="btn btn-outline-danger" title="Xóa" onclick="deleteItem({{$item->id}},'kích thước sản phẩm','{{route('delete_product_size')}}');"><i class="fa-solid fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalProductSize">Thêm kích thước</a>
                        </div>
                        <div class="col-12 mb-3 text-end">
                            <a href="{{route('list_product')}}" class="btn btn-dark">Trở lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalProductSize" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm kích thước</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="submitForm" data-url-submit="{{route('save_product_size')}}" data-url-complete="">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Giá</label>
                                    <input type="text" class="form-control currency-input" name="price" value="" placeholder="0">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giá giảm</label>
                                    <input type="text" class="form-control currency-input" name="discount" value="" placeholder="0">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kích thước</label>
                                    <select class="form-select" name="size">
                                        <option selected disabled value="">Chọn kích thước</option>
                                        @foreach ($sizes as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3 text-center">
                                <button class="btn btn-primary">Thêm</button>
                            </div>
                        </div>
                        <input type="hidden" name="productId" value="{{$product->id}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
