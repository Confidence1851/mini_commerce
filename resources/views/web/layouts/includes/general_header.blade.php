<header class="header-area sticky-bar section-padding-1">
    <div class="main-header-wrap">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2">
                    <div class="logo">
                        <a href="{{ route("web.index")}}">
                            <img src="{{$web_assets}}/images/logo/logo.png" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="main-menu">
                        @include("web.layouts.includes.main_menu_nav")
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2">
                    <div class="header-right-wrap">
                        <div class="same-style header-search ml-15">
                            <a class="search-active" href=""><i class="la la-search"></i></a>
                        </div>
                        @auth
                        <div class="same-style cart-wrap">
                            <a href="{{ route("web.shop.cart.index")}}" class="cart-active ml-15">
                                <i class="la la-shopping-cart"></i>
                                <span class="count-style cart_items_count">{{optional(cart())->items}}</span>
                            </a>
                        </div>
                        <div class="same-style setting-wrap ml-15">
                            <a  href="{{ route("user.dashboard")}}"><i class="la la-user"></i></a>
                        </div>
                        @else
                        <div class="same-style">
                            <a class="header_login_text" href="{{ route("login")}}">Login</a>
                        </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-small-mobile">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="mobile-logo">
                        <a href="{{ url('/') }}">
                            <img alt="" src="assets/images/logo/logo.png">
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="header-right-wrap">
                        <div class="same-style cart-wrap">
                            <a href="{{ route("web.shop.cart.index")}}" class="cart-active">
                                <i class="la la-shopping-cart"></i>
                                <span class="count-style cart_items_count">{{optional(cart())->items}}</span>
                            </a>
                        </div>
                        <div class="same-style mobile-off-canvas">
                            <a class="mobile-aside-button" href="#"><i class="la la-navicon"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
