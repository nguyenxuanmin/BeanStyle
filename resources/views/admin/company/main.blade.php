@extends('admin.layout.master-page')

@section('title')
    Thông tin công ty
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Thông tin công ty</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thông tin công ty</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm" enctype="multipart/form-data" data-url-submit="{{route('save_company')}}" data-url-complete="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên công ty</label>
                                    <input type="text" class="form-control" name="name" value="{{$company[0]->name}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" value="{{$company[0]->address}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hotline</label>
                                    <input type="text" class="form-control" name="hotline" value="{{$company[0]->hotline}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$company[0]->email}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày cuối flash sale</label>
                                    <input type="date" class="form-control" name="saleDate" value="@if (!empty($company[0]->sale_date)){{$company[0]->sale_date->format('Y-m-d');}}@else{{now()->format('Y-m-d');}}@endif">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control mb-3" name="logo" id="logo" accept="image/*">
                                    <div class="logoContent">
                                        <img id="logoContent" src="@if (!empty($company[0]->logo)){{asset('storage/company/logo/'.$company[0]->logo)}}@else{{asset('library/admin/default-image.png')}}@endif" alt="Logo preview" style="max-width: 100%; max-height: 150px;">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="favicon" class="form-label">Favicon</label>
                                    <input type="file" class="form-control mb-3" name="favicon" id="favicon" accept="image/*">
                                    <div class="faviconContent">
                                        <img id="faviconContent" src="@if (!empty($company[0]->favicon)){{asset('storage/company/favicon/'.$company[0]->favicon)}}@else{{asset('library/admin/default-image.png')}}@endif" alt="Favicon preview" style="max-width: 100%; max-height: 50px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3 text-end">
                                <button class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="id" value="{{$company[0]->id}}">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            document.getElementById('logo').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageUrl = e.target.result;
                        const imgElement = document.getElementById('logoContent'); 
                        imgElement.src = imageUrl; 
                        imgElement.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });

            document.getElementById('favicon').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageUrl = e.target.result;
                        const imgElement = document.getElementById('faviconContent'); 
                        imgElement.src = imageUrl; 
                        imgElement.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
