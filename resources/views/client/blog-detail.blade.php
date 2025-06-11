@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    <div class="container">
        <h1 class="item-blog-detail-title">{{$blog->name}}</h1>
        <div class="item-blog-detail-date">
            <span><i class="fa-solid fa-clock"></i> {{$blog->created_at->format("d-m-Y")}}</span>
            <span><i class="fa-solid fa-user"></i> Admin</span>
        </div>
        <div class="mb-3 clearfix">
            @php
                echo $blog->content;
            @endphp
        </div>
        <div class="title-detail">Tin tức liên quan</div>
        <div class="my-blog mx-15 mb-3 mb-lg-4">
            @foreach ($otherBlogs as $item)
                <div class="item-blog px-15">
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
            @endforeach
        </div>
    </div>
@endsection