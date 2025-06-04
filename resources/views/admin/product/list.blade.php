@extends('admin.layout.master-page')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Sản phẩm</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                    </ol>
                  </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="mb-3">
                <a class="btn btn-outline-primary" href="{{route('add_product')}}" title="Thêm">Thêm</a>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <form action="{{route('search_product')}}">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control form-control" placeholder="Tìm kiếm" value="{{$infoSearch}}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-8"></div>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="80px" class="text-center">STT</th>
                        <th scope="col" width="100px"></th>
                        <th scope="col" width="150px">Mã sản phẩm</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col" width="200px">Thương hiệu</th>
                        <th scope="col" width="150px">Kích thước</th>
                        <th scope="col" width="150px" class="text-center">Tình trạng</th>
                        <th scope="col" width="220px" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($products) == 0)
                        <tr>
                            <td valign="middle" align="center" colspan="8">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($products as $key => $product)
                        <tr>
                            <td valign="middle" align="center">{{$key+1}}</td>
                            <td valign="middle" align="center">
                                @if (count($product->productColors))
                                    <img src="{{asset('storage/products/' . basename($product->productColors[0]->productImages[0]->image))}}" alt="{{$product->name}}" class="object-fit-cover" style="max-width: 100%; max-height: 100px;">
                                @else
                                    <img src="{{asset('library/admin/default-image.png')}}" alt="{{$product->name}}" style="max-width: 100%; max-height: 100px;">
                                @endif
                            </td>
                            <td valign="middle">@if(empty($product->product_code)) Đang cập nhật @else{{$product->product_code}}@endif</td>
                            <td valign="middle">{{$product->name}}</td>
                            <td valign="middle">@if(!empty($product->brand_id)){{$product->brand->name}}@endif</td>
                            <td valign="middle">
                                @foreach ($product->productSizes as $key => $productSize)
                                    @if(empty($productSize->size)) Freesize @else @if($key > 0) , @endif {{$productSize->size->name}} @endif
                                @endforeach
                            </td>
                            <td valign="middle" align="center">
                                @if ($product->status == 1)
                                    <span class="badge text-bg-success">Còn hàng</span>
                                @else
                                    <span class="badge text-bg-warning">Hết hàng</span>
                                @endif
                            </td>
                            <td valign="middle" align="center">
                                <a href="{{route('update_product_size',[$product->id])}}" class="btn btn-outline-success" title="Cập nhật kích thước sản phẩm"><i class="fa-solid fa-expand"></i></a>
                                <a href="{{route('update_product_color',[$product->id])}}" class="btn btn-outline-secondary" title="Thêm màu sắc"><i class="fa-solid fa-palette"></i></a>
                                <a href="{{route('edit_product',[$product->id])}}" class="btn btn-outline-info" title="Sửa"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-outline-danger" title="Xóa" onclick="deleteItem({{$product->id}},'sản phẩm','{{route('delete_product')}}');"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$products->appends(['search' => $infoSearch])->links('admin.layout.pagination')}}
        </div>
    </div>
@endsection
