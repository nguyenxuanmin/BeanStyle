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
                            @if (count($productColors))
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Bảng màu sắc của sản phẩm</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 150px">Tên màu sắc</th>
                                                    <th>Hình ảnh</th>
                                                    <th style="width: 80px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($productColors as $item)
                                                    <tr class="align-middle">
                                                        <td>{{$item->color->name}}</td>
                                                        <td>
                                                            @foreach ($item->productImages as $productImage)
                                                                <img class="object-fit-cover" style="width:100px; height:100px; border-radius:10px; padding:5px;" src="{{asset('storage/products/' . basename($productImage->image))}}" alt="{{$item->color->name}}">
                                                            @endforeach
                                                        </td>
                                                        <td style="text-align: right;">
                                                            <button class="btn btn-outline-danger" title="Xóa" onclick="deleteItem({{$item->id}},'màu sắc sản phẩm','{{route('delete_product_color')}}');"><i class="fa-solid fa-trash"></i></button>
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
                            <a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalProductColor">Thêm màu sắc</a>
                        </div>
                        <div class="col-12 mb-3 text-end">
                            <a href="{{route('list_product')}}" class="btn btn-dark">Trở lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalProductColor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm màu sắc</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="submitForm" data-url-submit="{{route('save_product_color')}}" data-url-complete="">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Màu sắc</label>
                                    <select class="form-select" name="color">
                                        <option selected disabled value="">Chọn màu sắc</option>
                                        @foreach ($colors as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh</label><br>
                                    <input type="file" name="imageProduct[]" id="imageProduct" class="form-control mb-3" multiple accept="image/*">
                                    <div id="previewImageProduct"></div>
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
    <script>
        $(document).ready(function () {
            $('#imageProduct').on('change', function (event) {
                const preview = $('#previewImageProduct');
                preview.empty();
                const files = event.target.files;
                $.each(files, function (i, file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = $('<img>')
                        .attr('src', e.target.result)
                        .css({
                            width: '100px',
                            height: '100px',
                            margin: '5px',
                            border: '1px solid #ccc',
                            'object-fit': 'cover',
                            'border-radius': '5px'
                        });
                        preview.append(img);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
  </script>
@endsection
