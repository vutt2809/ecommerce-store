@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ url('admin/dashboard') }}">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h2><b>SnowRain</b></h2>
                    </div>
                </a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ $route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard')}}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ $prefix == '/brand' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="codepen"></i>
                    <span>Brand</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.brand' ? 'active' : '' }}"><a href="{{ route('all.brand') }}"><i class="ti-more"></i>All Brand</a></li>
                    <li><a href="calendar.html"><i class="ti-more"></i>Calendar</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/category' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="list"></i> <span>Category</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.category' ? 'active' : '' }}"><a href="{{ route('all.category') }}"><i class="ti-more"></i>All Category</a></li>
                    <li class="{{ $route == 'all.subcategory' ? 'active' : '' }}"><a href="{{ route('all.subcategory') }}"><i class="ti-more"></i>All SubCategory</a></li>
                    <li class="{{ $route == 'all.subsubcategory' ? 'active' : '' }}"><a href="{{ route('all.subsubcategory') }}"><i class="ti-more"></i>All Sub-SubCategory</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/product' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="archive"></i>
                    <span>Product</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'add.product' ? 'active' : '' }}"><a href="{{ route('add.product') }}"><i class="ti-more"></i>Add Products</a></li>
                    <li class="{{ $route == 'manage.product' ? 'active' : ''}}"><a href="{{ route('manage.product') }}"><i class="ti-more"></i>Manage Products</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/slider' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="sliders"></i>
                    <span>Slider</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'manage.slider' ? 'active' : '' }}"><a href="{{ route('manage.slider') }}"><i class="ti-more"></i>Add Slider</a></li>
                    <li class="{{ $route == 'manage.slider' ? 'active' : ''}}"><a href="{{ route('manage.slider') }}"><i class="ti-more"></i>Manage Slider</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/coupons' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="wind"></i>
                    <span>Coupon</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'manage.coupon' ? 'active' : ''}}"><a href="{{ route('manage.coupon') }}"><i class="ti-more"></i>Manage Coupons</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/shipping' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="map"></i>
                    <span>Shipping Area</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'manage.division' ? 'active' : ''}}"><a href="{{ route('manage.division') }}"><i class="ti-more"></i>Ship Division</a></li>
                    <li class="{{ $route == 'manage.district' ? 'active' : ''}}"><a href="{{ route('manage.district') }}"><i class="ti-more"></i>Ship District</a></li>
                    <li class="{{ $route == 'manage.state' ? 'active' : ''}}"><a href="{{ route('manage.state') }}"><i class="ti-more"></i>Ship State</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/orders' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="shopping-bag"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'pending.orders' ? 'active' : ''}}"><a href="{{ route('pending.orders') }}"><i class="ti-more"></i>Pending Orders</a></li>
                    <li class="{{ $route == 'confirmed.orders' ? 'active' : ''}}"><a href="{{ route('confirmed.orders') }}"><i class="ti-more"></i>Confirmed Orders</a></li>
                    <li class="{{ $route == 'processing.orders' ? 'active' : ''}}"><a href="{{ route('processing.orders') }}"><i class="ti-more"></i>Processing Orders</a></li>
                    <li class="{{ $route == 'picked.orders' ? 'active' : ''}}"><a href="{{ route('picked.orders') }}"><i class="ti-more"></i>Picked Orders</a></li>
                    <li class="{{ $route == 'shipped.orders' ? 'active' : ''}}"><a href="{{ route('shipped.orders') }}"><i class="ti-more"></i>Shipped Orders</a></li>
                    <li class="{{ $route == 'delivered.orders' ? 'active' : ''}}"><a href="{{ route('delivered.orders') }}"><i class="ti-more"></i>Delivered Orders</a></li>
                    <li class="{{ $route == 'cancel.orders' ? 'active' : ''}}"><a href="{{ route('cancel.orders') }}"><i class="ti-more"></i>Cancel Orders</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/return/list' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="shopping-bag"></i>
                    <span>Return Order</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'return.request' ? 'active' : ''}}"><a href="{{ route('return.request') }}"><i class="ti-more"></i>Return Request</a></li>
                    <li class="{{ $route == 'all.return.request' ? 'active' : ''}}"><a href="{{ route('all.return.request') }}"><i class="ti-more"></i>All Request</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/reports' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="bar-chart-2"></i>
                    <span>Report</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'manage.reports' ? 'active' : ''}}"><a href="{{ route('manage.reports') }}"><i class="ti-more"></i>Order By DMY</a></li>
                    <li class="{{ $route == 'manage.reports' ? 'active' : ''}}"><a href="{{ route('manage.reports') }}"><i class="ti-more"></i>Potental Customer</a></li>
                    <li class="{{ $route == 'manage-product-report' ? 'active' : ''}}"><a href="{{ route('manage-product-report') }}"><i class="ti-more"></i>Best Seller Product</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/alluser' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="user"></i>
                    <span>User</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'manage.user' ? 'active' : ''}}"><a href="{{ route('manage.user') }}"><i class="ti-more"></i>Manage User</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/blog' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="book-open"></i>
                    <span>Blog</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'blog.category' ? 'active' : ''}}"><a href="{{ route('blog.category') }}"><i class="ti-more"></i>Blog Category</a></li>
                    <li class="{{ $route == 'list.post' ? 'active' : ''}}"><a href="{{ route('list.post') }}"><i class="ti-more"></i>All Blog Post</a></li>
                    <li class="{{ $route == 'add.post' ? 'active' : ''}}"><a href="{{ route('add.post') }}"><i class="ti-more"></i>Add Blog Post</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/setting' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="book-open"></i>
                    <span>Site Setting</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'site.setting' ? 'active' : ''}}"><a href="{{ route('site.setting') }}"><i class="ti-more"></i>Site Setting</a></li>
                    <li class="{{ $route == 'seo.setting' ? 'active' : ''}}"><a href="{{ route('seo.setting') }}"><i class="ti-more"></i>Seo Setting</a></li>
                </ul>
            </li>
        </ul>

    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
