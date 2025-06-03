<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{route('admin')}}" class="brand-link">
            @if (count($company) && $company[0]->logo != "")
                <img src="{{asset('storage/company/logo/'.$company[0]->logo)}}" alt="{{$company[0]->name}}" class="brand-image opacity-75 shadow" />
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
                        <i class="fa-solid fa-layer-group"></i> <p>Danh mục sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_sub_category')}}" class="nav-link">
                        <i class="fa-solid fa-cube"></i> <p>Danh mục sản phẩm cấp 1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_brand')}}" class="nav-link">
                        <i class="fa-solid fa-bandage"></i> <p>Thương hiệu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_size')}}" class="nav-link">
                        <i class="fa-solid fa-expand"></i> <p>Kích thước</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_color')}}" class="nav-link">
                        <i class="fa-solid fa-palette"></i> <p>Màu sắc</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_product')}}" class="nav-link">
                        <i class="fa-solid fa-shop"></i> <p>Sản phẩm</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>