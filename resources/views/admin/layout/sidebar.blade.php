<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{route('admin')}}" class="brand-link">
            @if (!empty($company->logo))
                <img src="{{asset('storage/company/logo/'.$company->logo)}}" alt="{{$company->name}}" class="brand-image shadow" />
            @else
                <img src="{{asset('library/admin/AdminLTEFullLogo.png')}}" alt="AdminLTE Logo" class="brand-image shadow" />
            @endif
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item {{request()->is(['category*', 'sub-category*', 'brand*', 'size*', 'color*', 'product*']) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <p>
                            Sản phẩm
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('list_category')}}" class="nav-link {{request()->is('category*') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_sub_category')}}" class="nav-link {{request()->is('sub-category*') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục sản phẩm cấp 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_brand')}}" class="nav-link {{request()->is('brand*') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thương hiệu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_size')}}" class="nav-link {{request()->is('size*') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kích thước</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_color')}}" class="nav-link {{request()->is('color*') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Màu sắc</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_product')}}" class="nav-link {{request()->is('product*') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{request()->is(['about-us','why-choose-us*']) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <p>
                            Giới thiệu
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('about_us')}}" class="nav-link {{request()->is('about-us') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Về chúng tôi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list_why_choose_us')}}" class="nav-link {{request()->is('why-choose-us*') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tại sao chọn chúng tôi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_slider')}}" class="nav-link {{request()->is('slider*') ? 'active' : ''}}">
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_benefit')}}" class="nav-link {{request()->is('benefit*') ? 'active' : ''}}">
                        <p>Lợi ích</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_collection')}}" class="nav-link {{request()->is('collection*') ? 'active' : ''}}">
                        <p>Bộ sưu tập</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_advertisement')}}" class="nav-link {{request()->is('advertisement*') ? 'active' : ''}}">
                        <p>Quảng cáo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_blog')}}" class="nav-link {{request()->is('blog*') ? 'active' : ''}}">
                        <p>Tin tức</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_policy')}}" class="nav-link {{request()->is('policy*') ? 'active' : ''}}">
                        <p>Chính sách</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_instruct')}}" class="nav-link {{request()->is('instruct*') ? 'active' : ''}}">
                        <p>Hướng dẫn</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('company')}}" class="nav-link {{request()->is('company') ? 'active' : ''}}">
                        <p>Thông tin công ty</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>