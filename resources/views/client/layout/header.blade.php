<header id="header">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-6 col-xl-3 col-lg-3 col-md-4 header-left">
                    <div class="item-logo">
                        <a href="{{route('index')}}">
                            @if (!empty($company->logo))
                                <img src="{{asset('storage/company/logo/'.$company->logo)}}" alt="{{$company->name}}" class="w-100 h-100 object-fit-cover">
                            @else
                                LOGO
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-xl-5 col-lg-4 header-mid">
                    <div class="item-search">
                        <form action="" method="get">
                            <input type="search" id="inputSearch" name="search" class="form-control" placeholder="Tìm sản phẩm...">
                            <button type="submit" class="btn btn-search" title="Tìm kiếm"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                        <div id="resultSearch">
                            <div class="item-suggest">
                                <div class="search-title">Đề xuất phổ biến</div>
                                <div class="search-list">
                                    <a href="/search?q=Váy" title="Tìm kiếm váy">
                                        Váy
                                    </a>
                                    <a href="/search?q=Đầm" title="Tìm kiếm đầm">
                                        Đầm
                                    </a>
                                    <a href="/search?q=Áo%20nữ" title="Tìm kiếm áo sơ mi">
                                        Áo sơ mi
                                    </a>
                                    <a href="/search?q=Trang%20sức" title="Tìm kiếm áo khoác">
                                        Áo khoác
                                    </a>
                                    <a href="/search?q=Phụ%20kiện" title="Tìm kiếm phụ kiện">
                                        Phụ kiện
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-4 col-lg-5 col-md-8 header-right">
                    <div class="item-icon-cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span id="countCart">0</span>
                    </div>
                    <div id="itemMenuMobile" class="item-icon-menu ms-3">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class="container">
            <ul class="item-nav">
                <li>
                    <a href="" title="Trang chủ" @if (strpos($currentUrl, '') !== false) class="active" @endif>Trang chủ</a>
                </li>
                <li>
                    <a href="" title="Giới thiệu" @if (strpos($currentUrl, 'gioi-thieu') !== false) class="active" @endif>Giới thiệu</a>
                </li>
                <li>
                    <a id="displayDropdown" href="" title="Sản phẩm" @if (strpos($currentUrl, 'san-pham') !== false) class="active" @endif>Sản phẩm <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="dropdown-content">
                        <div class="container">
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-3 mb-3">
                                        <ul>
                                            <li>
                                                <a class="link-level-1" href="" title="{{$category->name}}">{{$category->name}}</a>
                                                <ul>
                                                    @foreach ($category->subCategories as $subCategory)
                                                        <li>
                                                            <a href="" title="{{$subCategory->name}}">{{$subCategory->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>	
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="" title="Tin tức" @if (strpos($currentUrl, 'tin-tuc') !== false) class="active" @endif>Tin tức</a>
                </li>
                <li>
                    <a href="" title="Liên hệ" @if (strpos($currentUrl, 'lien-he') !== false) class="active" @endif>Liên hệ</a>
                </li>
            </ul>
        </div>
    </div>
    <div id="menuMobile">
        <a id="itemHideMenu" href="javascript:void(0)"><i class="fa-solid fa-xmark"></i></a>
        <div class="item-logo-mobile">
            <a href="{{route('index')}}">
                @if (!empty($company->logo))
                    <img src="{{asset('storage/company/logo/'.$company->logo)}}" alt="{{$company->name}}" class="w-100 h-100 object-fit-cover">
                @else
                    LOGO
                @endif
            </a>
        </div>
        <ul class="item-nav-mobile">
            <li>
                <a href="" title="Trang chủ" @if (strpos($currentUrl, '') !== false) class="active" @endif>Trang chủ</a>
            </li>
            <li>
                <a href="" title="Giới thiệu" @if (strpos($currentUrl, 'gioi-thieu') !== false) class="active" @endif>Giới thiệu</a>
            </li>
            <li>
                <a href="#" title="Sản phẩm" @if (strpos($currentUrl, 'san-pham') !== false) class="active" @endif>Sản phẩm</a>
                <i class="fa-solid fa-angle-right toggle"></i>

                <ul class="sub-menu ps-2" style="display: none;">
                    @foreach ($categories as $category)
                        <li>
                            <a href="#" title="{{ $category->name }}">{{ $category->name }}</a>

                            @if (count($category->subCategories))
                                <i class="fa-solid fa-angle-right toggle"></i>
                                <ul class="sub-menu ps-2" style="display: none;">
                                    @foreach ($category->subCategories as $subCategory)
                                        <li>
                                            <a href="#" title="{{ $subCategory->name }}">{{ $subCategory->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="" title="Tin tức" @if (strpos($currentUrl, 'tin-tuc') !== false) class="active" @endif>Tin tức</a>
            </li>
            <li>
                <a href="" title="Liên hệ" @if (strpos($currentUrl, 'lien-he') !== false) class="active" @endif>Liên hệ</a>
            </li>
        </ul>
    </div>
</header>