<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{route('admin')}}" class="brand-link">
            @if (!empty($company->logo))
                <img src="{{asset('storage/company/logo/'.$company->logo)}}" alt="{{$company->name}}" class="brand-image opacity-75 shadow" />
            @else
                <img src="{{asset('library/admin/AdminLTEFullLogo.png')}}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            @endif
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('list_category')}}" class="nav-link">
                        <p>Danh mục sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_sub_category')}}" class="nav-link">
                        <p>Danh mục sản phẩm cấp 1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_brand')}}" class="nav-link">
                        <p>Thương hiệu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_size')}}" class="nav-link">
                        <p>Kích thước</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_color')}}" class="nav-link">
                        <p>Màu sắc</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_product')}}" class="nav-link">
                        <p>Sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_slider')}}" class="nav-link">
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_benefit')}}" class="nav-link">
                        <p>Lợi ích</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_collection')}}" class="nav-link">
                        <p>Bộ sưu tập</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_advertisement')}}" class="nav-link">
                        <p>Quảng cáo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_blog')}}" class="nav-link">
                        <p>Tin tức</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_policy')}}" class="nav-link">
                        <p>Chính sách</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_instruct')}}" class="nav-link">
                        <p>Hướng dẫn</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('company')}}" class="nav-link">
                        <p>Thông tin công ty</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>