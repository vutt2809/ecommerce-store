<header class="header-style-1"> 
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                <ul class="list-unstyled">
                    <li><a href="#"><i class="icon fa fa-user"></i>@if (session()->get('language') == 'vietnam') Tài khoản của tôi @else My Account @endif</a></li>
                    <li><a href="{{ route('wishlist')}}"><i class="icon fa fa-heart"></i>@if (session()->get('language') == 'vietnam') Yêu thích @else Wishlist @endif</a></li>
                    <li><a href="{{ route('mycart')}}"><i class="icon fa fa-shopping-cart"></i>@if (session()->get('language') == 'vietnam') Giỏ hàng  @else Shopping Cart @endif</a></li>
                    <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>@if (session()->get('language') == 'vietnam') Thanh toán  @else Checkout @endif</a></li>
                    <li>
                        @auth <a href="{{ route('user.profile')}}"><i class="icon fa fa-user"></i> {{ Auth::user()->name }}</a>
                        @else <a href="{{ route('login')}}"><i class="icon fa fa-lock"></i>@if (session()->get('language') == 'vietnam') Đăng nhập / Đăng kí  @else Login / Register @endif</a>
                        @endauth
                    </li>
                </ul>
                </div>
                <div class="cnt-block">
                <ul class="list-unstyled list-inline">
                    <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">USD</a></li>
                        <li><a href="#">INR</a></li>
                        <li><a href="#">GBP</a></li>
                    </ul>
                    </li>
                    <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">
                        @if (session()->get('language') == 'vietnam') Ngôn ngữ @else Language @endif 
                    </span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        @if (session()->get('language') == 'vietnam')
                        <li><a href="{{ route('english.language') }}">English</a></li>
                        @else
                        <li><a href="{{ route('vietnam.language') }}">Việt Nam</a></li>
                        @endif
                    </ul>
                    </li>
                </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 

                @php
                    $setting = App\Models\SiteSetting::find(1)
                @endphp

                <div class="logo"> <a href="{{ url('/') }}"> <img src="{{ asset($setting->logo) }}" alt="logo"> </a> </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
                    <div class="search-area">
                        <form>
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">@if (session()->get('language') == 'vietnam') Thể loại @else Categories @endif<b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu" >
                                    <li class="menu-header">Computer</li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                                    </ul>
                                </li>
                                </ul>
                                <input class="search-field" placeholder="Search here..." />
                                <a class="search-button" href="#" ></a> 
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 

                <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                    <div class="items-cart-inner">
                        <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                        <div class="basket-item-count"><span class="count" id="cart-quantity"></span></div>
                        <div class="total-price-basket"> 
                            <span class="lbl">@if (session()->get('language') == 'vietnam') Giỏ @else Cart @endif-</span> 
                            <span class="total-price"> 
                                <span class="sign">$</span>
                                <span class="value" id="cart-subtotal">0</span> 
                            </span> 
                        </div>
                    </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <!-- ============ Render List Cart Item Here ============-->
                            <div id="miniCart"></div>
                            <!-- ======================== End =======================-->
                            
                            <div class="clearfix cart-total">
                            <div class="pull-right"> <span class="text">Sub Total :</span><span id='cart-total'></span> </div>
                            <div class="clearfix"></div>
                            <a href="{{ route('checkout') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        <div class="nav-bg-class">
                        <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                            <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ url('/') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                                    @if (session()->get('language') == 'vietnam') Trang chủ @else Home @endif
                                    </a>
                                </li>

                                @php
                                $categories = App\Models\Category::orderBy('category_name_en', 'ASC')->get();
                                @endphp 

                                @foreach($categories as $category)
                                <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">@if (session()->get('language') == 'vietnam') {{ $category->category_name_vn }} @else {{ $category->category_name_en }} @endif</a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">
                                                @php
                                                $subCategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name_en', 'ASC')->get();
                                                @endphp

                                                @foreach($subCategories as $subCategory)
                                                <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                    <a href="{{ url('subcategory/product/'.$subCategory->id.'/'.$subCategory->subcategory_slug_en )}}">
                                                        <h2 class="title">@if (session()->get('language') == 'vietnam') {{$subCategory->subcategory_name_vn}} @else {{$subCategory->subcategory_name_en}} @endif</h2>                                    
                                                    </a>
                                                    @php
                                                    $Subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subCategory->id)->orderBy('subsubcategory_name_en', 'ASC')->get();
                                                    @endphp

                                                    @foreach($Subsubcategories as $subSubCategory)
                                                    <ul class="links">
                                                    <li><a href="{{url('subsubcategory/product/'.$subSubCategory->id.'/'.$subSubCategory->subsubcategory_slug_en )}}">@if (session()->get('language') == 'vietnam') {{$subSubCategory->subsubcategory_name_vn}} @else {{$subSubCategory->subsubcategory_name_en}} @endif</a></li>
                                                    </ul>
                                                    @endforeach
                                                </div>
                                                @endforeach

                                                <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/top-menu-banner.jpg') }}" alt=""> </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                @endforeach
                                <li class="dropdown  navbar-right special-menu"> <a href="#">@if (session()->get('language') == 'vietnam') Hot Deals hôm nay @else Todays offer @endif</a> </li>
                                <li class="dropdown  navbar-right special-menu"> <a href="{{ route('home.blog') }}">Blog</a> </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>