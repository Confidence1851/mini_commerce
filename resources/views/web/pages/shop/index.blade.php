@extends("web.layouts.app")
@section("content")
<div class="breadcrumb-area pt-95 pb-100 bg-img" style="background-image:url({{$web_assets}}/images/bg/breadcrumb.jpg);">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>Shop page</h2>
            </div>
            <ul>
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="active">Shop </li>
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
                            <form class="input-group" action="{{ url()->current() }}" method="GET">
                                <select class="form-control" name="orderBy">
                                    <option value="" disabled selected>Select Type</option>
                                    @foreach ($orderByOptions as $key => $options )
                                    <option value="{{$key}}" {{$key == request()->query('orderBy') ? "selected" : "" }}><a href="{{ url()->current() }}">{{ $options['label'] }}</a></option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-danger btn-sm ml-3">Filter</button>
                            </form>
                        </div>
                        @if($products->isempty())
                        <p>Showing 0 of 0 result</p>
                        @else
                        <p>Showing {{($products->currentpage()-1)*$products->perpage()+1}} to {{ $products->currentpage()*(($products->perpage() < $products->total()) ? $products->perpage(): $products->total())}} of {{ $products->total()}} result</p>
                        @endif
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
                                @if ($products->isNotempty())
                                @foreach ($products as $product)
                                @php
                                $in_cart = false;
                                if(auth()->check()){
                                $cart_item = cartitem(auth()->id() , $product->id);
                                $in_cart = !empty($cart_item);
                                }

                                @endphp
                                <div class="col-lg-6">
                                    <div class="shop-list-wrap mb-50">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6">
                                                <div class="product-wrap product-border-1">
                                                    <div class="product-img">
                                                        <a href="{{ $product->detailUrl() }}"><img src="{{ $product->getDefaultImage() }}" alt="product"></a>
                                                        <span class="product-badge">-30%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-7 col-md-7 col-sm-6">
                                                <div class="shop-list-content">
                                                    <h4><a href="{{ $product->detailUrl() }}">{{ $product->name }}</a></h4>
                                                    {{-- <div class="product-list-rating">
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                    </div> --}}
                                                    <div class="product-list-price">
                                                        <span>{{ $product->getPrice() }}</span>
                                                        <span class="old">{{ $product->price }}</span>
                                                    </div>
                                                    <p>{{ $product->description}}</p>
                                                    <div class="shop-list-btn-wrap">
                                                    @if ($product->status != "Inactive")
                                                        @auth
                                                        <div class="shop-list-cart default-btn btn-hover">
                                                            <a title="{{$in_cart ? "Remove From Cart" : "Add To Cart"}}" data-product_id="{{$product->id}}" data-url="{{route("web.shop.cart.save" , $product->id )}}" class="btn-group cart_add_or_remove_btn">
                                                                <span class="spinner spinner-border spinner-border-sm d-none"></span>
                                                                <span class="label">
                                                                    {{$in_cart ? "Remove From Cart" : "Add To Cart"}}
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="shop-list-wishlist default-btn btn-hover">
                                                            @livewire("shop.wishlist-component" , ["product" => $product])
                                                        </div>
                                                        @else
                                                        <div class="shop-list-cart default-btn btn-hover">
                                                            <a href="{{ route("login")}}">ADD TO CART</a>
                                                        </div>
                                                        <div class="shop-list-wishlist default-btn btn-hover">
                                                            <a href="{{ route("login")}}"><i class="la la-heart-o"></i></a>
                                                        </div>
                                                        @endauth
                                                        @else
                                                        <div class="shop-list-cart default-btn btn-hover">
                                                            <a title="Sold Out"  class="btn-group sold_btn ml-2">
                                                                Sold out
                                                            </a>
                                                        </div>

                                                        @endif

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="col-12 text-center">
                                    <div class="alert alert-danger p-4">{{$message}}</div>
                                </div>
                                @endif
                            </div>
                        </div>
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
@include("web.pages.shop.includes.cart_script")
