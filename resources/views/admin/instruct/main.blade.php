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
                        <li class="breadcrumb-item"><a href="{{route('list_instruct')}}">Hướng dẫn</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$titlePage}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm" enctype="multipart/form-data" data-url-submit="{{route('save_instruct')}}" data-url-complete="{{route('list_instruct')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề</label>
                                    <input type="text" class="form-control" name="name" value="@if (isset($instruct)){{$instruct->name}}@endif">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Nội dung</label>
                                <textarea name="content" id="contentSummernote">@if (isset($instruct)){{$instruct->content}}@endif</textarea>
                            </div>
                            <div class="col-12 mb-3 text-end">
                                @if ($action == 'add')
                                    <button class="btn btn-primary">Thêm</button>
                                @else
                                    <button class="btn btn-info">Cập nhật</button>
                                @endif
                                <a href="{{route('list_instruct')}}" class="btn btn-dark">Trở lại</a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="{{$action}}">
                    <input type="hidden" name="id" value="@if (isset($instruct)){{$instruct->id}}@endif">
                </form>
            </div>
        </div>
    </div>
@endsection
