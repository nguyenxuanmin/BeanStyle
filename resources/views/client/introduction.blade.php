@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    <div class="container">
        <div class="item-category-title"><h2>Cửa Hàng Quần Áo Bean Style</h2></div>
        <div class="introduction">
            <div class="row">
				<div class="col-lg-3 col-6">
					<div class="introduction-content">
						<span class="introduction-num">2</span>
						<span class="introduction-title">Năm kinh nghiệm</span>
					</div>
				</div>
				<div class="col-lg-3 col-6">
					<div class="introduction-content">
						<span class="introduction-num">200</span>
						<span class="introduction-title">Nhân viên</span>
					</div>
				</div>
				<div class="col-lg-3 col-6">
					<div class="introduction-content">
						<span class="introduction-num">3000+</span>
						<span class="introduction-title">Khách hàng</span>
					</div>
				</div>
				<div class="col-lg-3 col-6">
					<div class="introduction-content">
						<span class="introduction-num">8</span>
						<span class="introduction-title">Cửa hàng</span>
					</div>
				</div>
			</div>
        </div>
    </div>
    @if ($aboutUs)
        <div class="about-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        @if (!empty($aboutUs->image))
                            <div class="about-us-image">
                                <img src="{{asset('storage/about-us/image/'.$aboutUs->image)}}" alt="{{$aboutUs->title}}" class="img-fluid object-fit-cover">
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="about-us-content">
                            <h2 class="about-us-title">Về chúng tôi!</h2>
                            <p class="about-us-title-2">{{$aboutUs->title}}</p>
                            <p class="about-us-description">{{$aboutUs->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection