@extends('admin.layout.master-page')

@section('title')
    Tại sao chọn chúng tôi
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tại sao chọn chúng tôi</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Tại sao chọn chúng tôi</li>
                    </ol>
                  </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="mb-3">
                <a class="btn btn-outline-primary" href="{{route('add_why_choose_us')}}" title="Thêm">Thêm</a>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <form action="{{route('search_why_choose_us')}}">
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
                        <th scope="col">Tiêu đề</th>
                        <th scope="col" width="500px">Mô tả</th>
                        <th scope="col" width="200px">Ngày tạo</th>
                        <th scope="col" width="150px" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($whyChooseUsItems) == 0)
                        <tr>
                            <td valign="middle" align="center" colspan="4">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($whyChooseUsItems as $key => $whyChooseUsItem)
                        <tr>
                            <td valign="middle" align="center">{{$key+1}}</td>
                            <td valign="middle">{{$whyChooseUsItem->title}}</td>
                            <td valign="middle">{{ \Illuminate\Support\Str::limit($whyChooseUsItem->description, 300, '...') }}</td>
                            <td valign="middle">{{$whyChooseUsItem->created_at->format('d/m/Y');}}</td>
                            <td valign="middle" align="center">
                                <a href="{{route('edit_why_choose_us',[$whyChooseUsItem->id])}}" class="btn btn-outline-info" title="Sửa"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-outline-danger" title="Xóa" onclick="deleteItem({{$whyChooseUsItem->id}},'tại sao chọn chúng tôi','{{route('delete_why_choose_us')}}');"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$whyChooseUsItems->appends(['search' => $infoSearch])->links('admin.layout.pagination')}}
        </div>
    </div>
@endsection
