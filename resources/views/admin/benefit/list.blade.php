@extends('admin.layout.master-page')

@section('title')
    Lợi ích
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Lợi ích</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Lợi ích</li>
                    </ol>
                  </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="mb-3">
                <a class="btn btn-outline-primary" href="{{route('add_benefit')}}" title="Thêm">Thêm</a>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <form action="{{route('search_benefit')}}">
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
                        <th scope="col" width="100px" class="text-center">STT</th>
                        <th scope="col" style="width:200px;"></th>
                        <th scope="col">Lợi ích</th>
                        <th scope="col" width="150px" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($benefits) == 0)
                        <tr>
                            <td valign="middle" align="center" colspan="4">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($benefits as $key => $benefit)
                        <tr>
                            <td valign="middle" align="center">{{$key+1}}</td>
                            <td valign="middle">
                                <img src="@if (!empty($benefit->image)){{asset('storage/benefits/' . basename($benefit->image))}}@else{{asset('library/admin/default-image.png')}}@endif" alt="{{$benefit->name}}" style="max-width: 100%; max-height: 200px;">
                            </td>
                            <td valign="middle">{{$benefit->name}}</td>
                            <td valign="middle" align="center">
                                <a href="{{route('edit_benefit',[$benefit->id])}}" class="btn btn-outline-info" title="Sửa"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-outline-danger" title="Xóa" onclick="deleteItem({{$benefit->id}},'lợi ích','{{route('delete_benefit')}}');"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$benefits->appends(['search' => $infoSearch])->links('admin.layout.pagination')}}
        </div>
    </div>
@endsection
