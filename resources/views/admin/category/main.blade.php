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
                        <li class="breadcrumb-item"><a href="{{route('list_category')}}">Danh mục sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$titlePage}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm" enctype="multipart/form-data" data-url-submit="{{route('save_category')}}" data-url-complete="{{route('list_category')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên danh mục sản phẩm</label>
                                    <input type="text" class="form-control" name="name" value="@if (isset($category)){{$category->name}}@endif">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control mb-3" name="image" id="imageUpload" accept="image/*">
                                    <div class="imageContent">
                                        <img id="imageContent" src="@if (isset($category) && $category->image != ""){{asset('storage/categories/image/' . basename($category->image))}}@else{{asset('library/admin/default-image.png')}}@endif" alt="Image preview" style="max-width: 100%; max-height: 150px;">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Icon</label>
                                    <input type="file" class="form-control mb-3" name="icon" id="iconUpload" accept="image/*">
                                    <div class="iconContent">
                                        <img id="iconContent" src="@if (isset($category) && $category->icon != ""){{asset('storage/categories/icon/' . basename($category->icon))}}@else{{asset('library/admin/default-image.png')}}@endif" alt="Image preview" style="max-width: 100%; max-height: 50px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Nội dung</label>
                                <textarea name="content" id="contentSummernote">@if (isset($category)){{$category->content}}@endif</textarea>
                            </div>
                            <div class="col-12 mb-3 text-end">
                                @if ($action == 'add')
                                    <button class="btn btn-primary">Thêm</button>
                                @else
                                    <button class="btn btn-info">Cập nhật</button>
                                @endif
                                <a href="{{route('list_category')}}" class="btn btn-dark">Trở lại</a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="{{$action}}">
                    <input type="hidden" name="id" value="@if (isset($category)){{$category->id}}@endif">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            document.getElementById('iconUpload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageUrl = e.target.result;
                        const imgElement = document.getElementById('iconContent'); 
                        imgElement.src = imageUrl; 
                        imgElement.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
