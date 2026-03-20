@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="section-box-filter">
                    <div class="aside-content">
                        <div class="aside-title">Danh mục sản phẩm</div>
                        <ul class="category-navbar">
                            @foreach ($categories as $category)
                                @php
                                    if (isset($activeCategory) && $activeCategory->id == $category->id){
                                        $isCategory = 'y';
                                    }else{
                                        $isCategory = 'n';
                                    }
                                @endphp
                                <li @if ($isCategory == 'y') class="active" @endif>
                                    <a class="nav-link-lv1" href="{{route('category',$category->slug)}}">{{ $category->name }}</a>
                                    @if (count($category->subCategories) > 0)
                                        <i class="fa-solid fa-plus"></i>
                                        <ul class="sub-category-navbar">
                                            @foreach ($category->subCategories as $subCategory)
                                                @php
                                                    if (isset($activeSubCategory) && $activeSubCategory->id == $subCategory->id){
                                                        $isSubCategory = 'y';
                                                    }else{
                                                        $isSubCategory = 'n';
                                                    }
                                                @endphp
                                                <li @if ($isSubCategory == 'y') class="active-sub-category" @endif>
                                                    <a href="{{route('sub_category',[$category->slug,$subCategory->slug])}}">{{ $subCategory->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="product-bg" style="background-image:url({{asset('library/client/bg_collections.jpg')}});">
					<span>{{$titlePage}}</span>
                </div>
                @if (count($products) == 0)
                    <div class="alert alert-warning">
						Sản phẩm đang được cập nhật.
					</div>
                @else
                    <div class="row">
                        @foreach ($products as $item)
                            @php
                                $price = $item->productSizes[0]->price;
                                $discount = $item->productSizes[0]->discount;
                                $flashSale = (($price - $discount) / $price) * 100;
                            @endphp
                            <div class="col-6 col-lg-3 mb-3 mb-lg-4">
                                <div  class="item-product">
                                        <div class="item-product-badge">
                                            @if ($item->isNew == 1)
                                                <span class="item-product-badge-new">Hàng mới</span>
                                            @endif
                                            @if ($item->isBestSeller == 1)
                                                <span class="item-product-badge-best">Bán chạy</span>
                                            @endif
                                        </div>
                                        <div class="item-product-image">
                                            <a href="">
                                                <img src="{{asset('storage/products/'.$item->productColors[0]->productImages[0]->image)}}" alt="{{$item->name}}" class="w-100 h-100 object-fit-cover">
                                            </a>
                                        </div>
                                        <div class="item-product-info">
                                            <div class="item-product-vendor-color">
                                                <span class="item-product-vendor">{{$item->brand->name}}</span>
                                                <div class="item-product-color">
                                                    @foreach ($item->productColors as $k => $productColor)
                                                        @if ($k < 3)
                                                            <span style="background: {{$productColor->color->color_code}};"></span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <h3><a href="" title="{{$item->name}}">{{$item->name}}</a></h3>
                                            <span class="item-product-discount">{{number_format($discount, 0, ',', '.')}}đ</span><span class="item-product-flash-sale">-{{round($flashSale)}}%</span>
                                            <span class="item-product-price">{{number_format($price, 0, ',', '.')}}₫</span>
                                        </div>
                                    </div>
                            </div>
                        @endforeach
                    </div>
                    {{$products->links('client.layout.pagination')}}
                @endif
            </div>
        </div>
        
    </div>
@endsection