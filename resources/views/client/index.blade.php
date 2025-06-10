@extends('client.layout.master-page')

@section('title')
    Trang chủ
@endsection

@section('content')
    @if (count($sliders))
        <section class="section-slider">
            <div class="my-slider">
                @foreach ($sliders as $slider)
                    <div class="item-slider">
                        <img src="{{asset('storage/sliders/'.$slider->image)}}" alt="{{$slider->name}}" class="w-100 h-100 object-fit-cover">
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    @if (count($benefits))
        <section class="section-index section-benefit">
            <div class="container">
                <div class="row">
                    @foreach ($benefits as $item)
                        <div class="col-6 col-lg-3">
                            <div class="item-benefit">
                                <div class="item-benefit-image">
                                    <img src="{{asset('storage/benefits/'.$item->image)}}" alt="{{$item->name}}" class="object-fit-cover">
                                </div>
                                <div class="item-benefit-info">
                                    <h3>{{$item->name}}</h3>
                                    <span>{{$item->description}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (count($collections))
        <section class="section-index section-collection">
            <div class="container">
                <div class="row">
                    @foreach ($collections as $item)
                        <div class="col-6 col-lg-3 mb-3 lg-mb-0">
                            <div class="item-collection">
                                <img src="{{asset('storage/collections/'.$item->image)}}" alt="{{$item->name}}" class="w-100 h-100 object-fit-cover">
                                <div class="item-collection-info">
                                    <h3>{{$item->name}}</h3>
                                    <a href="" title="Xem chi tiết">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (count($categories))
        <section class="section-index section-category">
            <div class="container">
                <div class="item-category-title"><h2>Danh mục nổi bật</h2></div>
                <div class="item-category">
                    @foreach ($categories as $item)
                        @php
                            $productCount = $item->subCategories->sum('products_count');
                        @endphp
                        <div class="item-category-info">
                            <a href="" title="{{$item->name}}">
                                <img src="{{asset('storage/categories/'.$item->image)}}" alt="{{$item->name}}" class="object-fit-cover">
                                <div class="item-category-content">
                                    <h3>{{$item->name}}</h3>
                                    <span>{{$productCount}}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (count($saleProducts))
        <section class="section-index section-sale-product">
            <div class="container">
                <div class="item-sale-product">
                    <div class="item-sale-product-header">
                        <h2>
                            <a href="" title="FLASH SALE">
                                <img src="{{asset('library/client/flash.webp')}}" alt="FLASH SALE" class="object-fit-cover">
                                FLASH SALE
                            </a>
                        </h2>
                        <div class="item-sale-product-count-down" id="countdown">
                            <p><span id="countdownDays">0</span><span>Ngày</span></p>
                            <p><span id="countdownHours">0</span></p>
                            <p><span id="countdownMinutes">0</span></p>
                            <p><span id="countdownSeconds">0</span></p>
                        </div>
                    </div>
                    <div class="my-product mx-15">
                        @foreach ($saleProducts as $item)
                            @php
                                $price = $item->productSizes[0]->price;
                                $discount = $item->productSizes[0]->discount;
                                $flashSale = (($price - $discount) / $price) * 100;
                            @endphp
                            <div class="px-15">
                                <div class="item-product">
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
                </div>
            </div>
        </section>
    @endif
    @if (isset($advFirst))
        <section class="section-index section-adv-first">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3 lg-mb-0">
                            <span class="item-adv-first-sub-title">Hàng mới về</span>
                            <h2 class="item-adv-first-title">@php echo $advFirst->name @endphp</h2>
                            <div class="item-adv-first-desc">{{$advFirst->description}}</div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="item-adv-first-image">
                            <img src="{{asset('storage/advertisements/'.$advFirst->image)}}" alt="{{$advFirst->name}}" class="w-100 h-100 object-fit-cover">
                        </div>
                    </div>
                </div>
                <span class="d-lg-block d-none item-adv-first-bg">Style</span>
            </div>
        </section>
    @endif
    <section class="section-index section-all-product">
        <div class="container">
            <div class="title-index">
                <h2>
                    <a href="" title="Tất Cả Sản Phẩm">Tất cả sản phẩm</a>
                </h2>
                <ul class="item-product-tab">
                    <li data-status="new" class="active">Hàng mới về</li>
                    <li data-status="best-seller">Sản phẩm bán chạy</li>
                    <li data-status="hot">Sản phẩm nổi bật</li>
                </ul>
            </div>
            <div id="allProduct">
            </div>
        </div>
    </section>
    @if (count($advs))
        <section class="section-index section-adv">
            <div class="container">
               <div class="my-adv mx-15">
                    @foreach ($advs as $item)
                        <div class="px-15">
                            <div class="item-adv-image">
                                <img src="{{asset('storage/advertisements/'.$item->image)}}" alt="{{$item->name}}" class="object-fit-cover">
                            </div>
                        </div>
                    @endforeach
               </div>
            </div>
        </section>
    @endif
    @if (count($blogs))
        <section class="section-index section-blog">
            <div class="container">
                <div class="title-index">
                    <h2>
                        <a href="" title="Tin tức mới nhất">Tin tức mới nhất</a>
                    </h2>
                    <p class="sub-title-index">Cập nhật những tin tức thời trang mới nhất</p>
                </div>
                <div class="my-blog mx-15">
                    @foreach ($blogs as $item)
                        <div class="item-blog px-15">
                            <div class="item-blog-image">
                                <a href="http://">
                                    <img src="{{asset('storage/blogs/'.$item->image)}}" alt="{{$item->name}}" class="w-100 h-100 object-fit-cover">
                                </a>
                            </div>
                            <div class="item-blog-info">
                                <h3><a href="" title="{{$item->name}}">{{$item->name}}</a></h3>
                                <p>{{$item->description}}</p>
                                <a href="" class="read-more">Xem thêm >></a>
                            </div>
                        </div>
                    @endforeach
               </div>
            </div>
        </section>
    @endif
@endsection
