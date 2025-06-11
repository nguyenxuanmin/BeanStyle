@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    <div class="container">
        <div class="row">
            @foreach ($blogs as $item)
                <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-4">
                     <div class="item-blog">
                        <div class="item-blog-image">
                            <a href="{{route('blog_detail',$item->slug)}}">
                                <img src="{{asset('storage/blogs/'.$item->image)}}" alt="{{$item->name}}" class="w-100 h-100 object-fit-cover">
                                <span>{{$item->created_at->format('d-m-Y')}}</span>
                            </a>
                        </div>
                        <div class="item-blog-info">
                            <h3><a href="{{route('blog_detail',$item->slug)}}" title="{{$item->name}}">{{$item->name}}</a></h3>
                            <p>{{$item->description}}</p>
                            <a href="{{route('blog_detail',$item->slug)}}" class="read-more">Xem thêm >></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$blogs->links('client.layout.pagination')}}
    </div>
@endsection