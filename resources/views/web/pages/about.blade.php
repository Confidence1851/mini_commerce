@extends("web.layouts.app")
@section("content")

<body>

    <div class="main-wrapper wrapper-2">
               <div class="mobile-off-canvas-active">
            <a class="mobile-aside-close"><i class="la la-close"></i></a>
            <div class="header-mobile-aside-wrap">
                <div class="mobile-search">
                    <form class="search-form" action="#">
                        <input type="text" placeholder="Search entire store?">
                        <button class="button-search"><i class="la la-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap">
                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><a href="{{ url('/') }}">Home</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ url('/') }}">Home version 1 </a></li>
                                        <li><a href="index-2.html">Home version 2 </a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children "><a href="shop.html">shop</a>
                                    <ul class="dropdown">
                                        <li class="menu-item-has-children"><a href="#">Shop Layout</a>
                                            <ul class="dropdown">
                                                <li><a href="shop.html">standard style</a></li>
                                                <li><a href="shop-2col.html">grid 2 column</a></li>
                                                <li><a href="shop-right-sidebar.html">grid right sidebar</a></li>
                                                <li><a href="shop-grid-no-sidebar.html">grid no sidebar</a></li>
                                                <li><a href="shop-grid-fw.html">grid full wide</a></li>
                                                <li><a href="shop-list.html">list 1 column</a></li>
                                                <li><a href="shop-list-fw-2col.html">list 2 column</a></li>
                                                <li><a href="shop-list-fw.html">list full wide</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">products details</a>
                                            <ul class="dropdown">
                                                <li><a href="product-details.html">tab style 1</a></li>
                                                <li><a href="product-details-tab-2.html">tab style 2</a></li>
                                                <li><a href="product-details-tab-3.html">tab style 3</a></li>
                                                <li><a href="product-details-gallery.html">gallery style </a></li>
                                                <li><a href="product-details-sticky.html">sticky style</a></li>
                                                <li><a href="product-details-sticky-right.html">sticky right</a></li>
                                                <li><a href="product-details-slider-box.html">slider style</a></li>
                                                <li><a href="product-details-affiliate.html">Affiliate style</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Accessories </a></li>
                                <li class="menu-item-has-children"><a href="#">pages</a>
                                    <ul class="dropdown">
                                        <li><a href="about-us.html">about us </a></li>
                                        <li><a href="cart.html">cart page </a></li>
                                        <li><a href="checkout.html">checkout </a></li>
                                        <li><a href="compare.html">compare </a></li>
                                        <li><a href="wishlist.html">wishlist </a></li>
                                        <li><a href="my-account.html">my account </a></li>
                                        <li><a href="contact.html">contact us </a></li>
                                        <li><a href="login-register.html">login/register </a></li>
                                        <li><a href="404.html">404 page </a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children "><a href="blog.html">Blog</a>
                                    <ul class="dropdown">
                                        <li><a href="blog.html">standard style </a></li>
                                        <li><a href="blog-no-sidebar.html"> blog no sidebar </a></li>
                                        <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact-us.html">Contact us</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-curr-lang-wrap">
                    <div class="single-mobile-curr-lang">
                        <a class="mobile-language-active" href="#">Language <i class="la la-angle-down"></i></a>
                        <div class="lang-curr-dropdown lang-dropdown-active">
                            <ul>
                                <li><a href="#">English (US)</a></li>
                                <li><a href="#">English (UK)</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-mobile-curr-lang">
                        <a class="mobile-currency-active" href="#">Currency <i class="la la-angle-down"></i></a>
                        <div class="lang-curr-dropdown curr-dropdown-active">
                            <ul>
                                <li><a href="#">USD</a></li>
                                <li><a href="#">EUR</a></li>
                                <li><a href="#">Real</a></li>
                                <li><a href="#">BDT</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-mobile-curr-lang">
                        <a class="mobile-account-active" href="#">My Account <i class="la la-angle-down"></i></a>
                        <div class="lang-curr-dropdown account-dropdown-active">
                            <ul>
                                <li><a href="login-register.html">Login</a></li>
                                <li><a href="login-register.html">Creat Account</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="quick-info">
                    <ul>
                        <li><i class="la la-phone"></i> +012 456 789</li>
                        <li> <i class="la la-envelope"></i> <a href="#">INFO@EXAMPLE.COM</a></li>
                        <li> <i class="la la-clock-o"></i> MON-SAT:8AM TO 9PM</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- search start -->
        <div class="search-content-wrap main-search-active">
            <a class="search-close"><i class="la la-close"></i></a>
            <div class="search-content">
                <p>Start typing and press Enter to search</p>
                <form class="search-form" action="#">
                    <input type="text" placeholder="Search entire store?">
                    <button class="button-search"><i class="la la-search"></i></button>
                </form>
            </div>
        </div>
        <!-- mini cart start -->
        <div class="sidebar-cart-active">
            <div class="sidebar-cart-all">
                <a class="cart-close" href="#"><i class="la la-close"></i></a>
                <div class="cart-content">
                    <h3>Shopping Cart</h3>
                    <ul>
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="#"><img src="assets/images/cart/cart-1.jpg" alt=""></a>
                            </div>
                            <div class="cart-title">
                                <h4><a href="#"> Flower Dress </a></h4>
                                <span>1 ? ?54.00</span>
                            </div>
                            <div class="cart-delete">
                                <a href="#">?</a>
                            </div>
                        </li>
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="#"><img src="assets/images/cart/cart-2.jpg" alt=""></a>
                            </div>
                            <div class="cart-title">
                                <h4><a href="#">Ruffled cotton top</a></h4>
                                <span>1 ? ?54.00</span>
                            </div>
                            <div class="cart-delete">
                                <a href="#">?</a>
                            </div>
                        </li>
                    </ul>
                    <div class="cart-total">
                        <h4>Subtotal: <span>? 108.00</span></h4>
                    </div>
                    <div class="cart-checkout-btn btn-hover default-btn">
                        <a class="btn-size-md btn-bg-black btn-color" href="cart.html">view cart</a>
                        <a class="no-mrg btn-size-md btn-bg-black btn-color" href="checkout.html">checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-area pt-95 pb-100 bg-img" style="background-image:url({{$web_assets}}/images/bg/breadcrumb.jpg);">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <div class="breadcrumb-title">
                        <h2>About us page</h2>
                    </div>
                    <ul>
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="active">About us </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="about-story pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h3>Eliza Story.</h3>
                            <h6>Lorem ipsum dolor sit, consectetur adipisicing elit, sed eiusmod doil incididunt utb labore et dolore magna aliqua. Ut enim ad minim veniam quis nost.</h6>
                            <p>Lorem ipsum dolor sit, con adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitati ullamco laboris nisi ut aliquip ex ea com.</p>
                            <p>Modo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu dolore eu fugiat pariatur.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="assets/images/banner/banner-5.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="feature-area pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="feature-wrap mb-30">
                            <div class="feature-img">
                                <img src="{{$web_assets}}/images/icon-img/feature-1.png" alt="">
                            </div>
                            <div class="feature-content">
                                <h5>FREE SHIPPING</h5>
                                <p>Free shipping on all order</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="feature-wrap mb-30">
                            <div class="feature-img">
                                <img src="{{$web_assets}}/images/icon-img/feature-2.png" alt="">
                            </div>
                            <div class="feature-content">
                                <h5>ONLINE SUPPORT</h5>
                                <p>Online support 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="feature-wrap mb-30">
                            <div class="feature-img">
                                <img src="{{$web_assets}}/images/icon-img/feature-3.png" alt="">
                            </div>
                            <div class="feature-content">
                                <h5>MONEY RETURN</h5>
                                <p>Back guarantee under 5 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-area">
            <div class="container">
                <div class="bg-img pt-150 pb-150 video-bg-img" style="background-image:url({{$web_assets}}/images/bg/bg-2.jpg);">
                    <div class="video-content text-center">
                        <h2>Offering the best services<h2>
                        <div class="video-icon">
                            <a class="video-popup" href="https://player.vimeo.com/video/181061053?autoplay=1&amp;byline=0&amp;collections=0"><i class="la la-play-circle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="banner-wrap mb-30">
                            <a href="product-details.html"><img class="animated" src="{{$web_assets}}/images/banner/banner-1.png" alt=""></a>
                            <div class="banner-content banner-position-1">
                                <h3>Fashionable <br>ladies Bag</h3>
                                <div class="banner-btn">
                                    <a href="product-details.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="banner-wrap mb-30">
                            <a href="product-details.html"><img class="animated" src="{{$web_assets}}/images/banner/banner-2.png" alt=""></a>
                            <div class="banner-content banner-position-1">
                                <h3>Dj Fashion <br>Man Shoes</h3>
                                <div class="banner-btn">
                                    <a href="product-details.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-area bg-gray pb-100 pt-95">
            <div class="container">
                <div class="testimonial-active owl-carousel">
                    <div class="single-testimonial text-center">
                        <img src="assets/images/testimonial/testi-1.png" alt="">
                        <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labor et dolore magna aliqua ex commo consequat irure "</p>
                        <span>Tayeb Rayed</span>
                    </div>
                    <div class="single-testimonial text-center">
                        <img src="assets/images/testimonial/testi-2.png" alt="">
                        <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labor et dolore magna aliqua ex commo consequat irure "</p>
                        <span>Arham Rafan</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
@endsection
