<div class="item-breadcrumb">
    <div class="container">
        <div class="item-list-breadcrumb">
            <a href="{{route('index')}}">Trang chủ</a> <i class="fa-solid fa-chevron-right"></i> @if (isset($breadcrumb1)) <a href="{{$breadcrumbLink1}}">{{$breadcrumb1}}</a> <i class="fa-solid fa-chevron-right"></i> @endif @if (isset($breadcrumb2)) <a href="{{$breadcrumbLink2}}">{{$breadcrumb2}}</a> <i class="fa-solid fa-chevron-right"></i> @endif <span>{{$titlePage}}</span>
        </div>
    </div>
</div>