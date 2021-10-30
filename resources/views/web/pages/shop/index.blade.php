@extends("web.layouts.app")
@section("content")
<div class="breadcrumb-area pt-95 pb-100 bg-img" style="background-image:url(assets/images/bg/breadcrumb.jpg);">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>shop page</h2>
            </div>
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li class="active">shop list 2 column </li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-area pt-95 pb-100 section-padding-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-top-bar">
                    <div class="select-shoing-wrap">
                        <div class="shop-select">
                            <select>
                                <option value="">Sort by newness</option>
                                <option value="">A to Z</option>
                                <option value=""> Z to A</option>
                                <option value="">In stock</option>
                            </select>
                        </div>
                        <p>Showing 1–12 of 20 result</p>
                    </div>
                    <div class="shop-tab nav">
                        <a href="#shop-1" data-bs-toggle="tab">
                            <i class="la la-th-large"></i>
                        </a>
                        <a class="active" href="#shop-2" data-bs-toggle="tab">
                            <i class="la la-reorder"></i>
                        </a>
                    </div>
                </div>
                <div class="shop-bottom-area mt-35">
                    <div class="tab-content jump">
                        <div id="shop-1" class="tab-pane">
                            <div class="row">
                                @foreach ($products as $product)
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                                   @include("web.pages.shop.fragments.single_product")
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="shop-2" class="tab-pane active">
                            <div class="row">
                                @foreach ($products as $product)
                                <div class="col-lg-6">
                                    <div class="shop-list-wrap mb-50">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6">
                                                <div class="product-wrap product-border-1">
                                                    <div class="product-img">
                                                        <a href="#">
                                                            <img src="assets/images/product/hm1-pro-1.jpg" alt="product">
                                                        </a>
                                                        <span class="product-badge">-30%</span>
                                                        <div class="product-action">
                                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" title="Quick View" href="#"><i class="la la-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-7 col-md-7 col-sm-6">
                                                <div class="shop-list-content">
                                                    <h3><a href="#">Products Name Here</a></h3>
                                                    <div class="product-list-rating">
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                    </div>
                                                    <div class="product-list-price">
                                                        <span>$ 60.00</span>
                                                        <span class="old">$ 90.00</span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
                                                    <div class="shop-list-btn-wrap">
                                                        <div class="shop-list-cart default-btn btn-hover">
                                                            <a href="#">ADD TO CART</a>
                                                        </div>
                                                        <div class="shop-list-wishlist default-btn btn-hover">
                                                            <a href="#"><i class="la la-heart-o"></i></a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    {!! $products->links("pagination::bootstrap-4")!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
