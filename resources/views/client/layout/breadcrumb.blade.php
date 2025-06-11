<div class="item-breadcrumb">
    <div class="container">
        <div class="item-list-breadcrumb">
            <a href="{{route('index')}}">Trang chủ</a> <i class="fa-solid fa-chevron-right"></i> @if (isset($category)) <a href="{{route($categoryLink)}}">{{$category}}</a> <i class="fa-solid fa-chevron-right"></i> @endif <span>{{$titlePage}}</span>
        </div>
    </div>
</div>