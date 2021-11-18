@extends("web.layouts.app")
@section("content")
<div class="breadcrumb-area pt-95 pb-100 bg-img" style="background-image:url({{$web_assets}}/images/bg/breadcrumb.jpg);">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>Product details</h2>
            </div>
            <ul>
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="active">Product details </li>
            </ul>
        </div>
    </div>
</div>
<div class="product-details-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-img">
                    <div class="zoompro-border zoompro-span">
                        <img class="zoompro" src="{{ $product->getDefaultImage() }}" data-zoom-image="{{ $product->getDefaultImage() }}" alt="" /> <span>-{{ $product->discountPercent() }}%</span>
                    </div>
                    <div id="gallery" class="mt-20 product-dec-slider">
                        @foreach ($product->images as $image)
                        <a data-image="{{ $image->url() }}" data-zoom-image="{{ $image->url() }}">
                            <img src="{{ $image->url() }}" alt="" class="img-fluid">
                        </a>
                        @endforeach

                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product-details-content ml-30">
                    <h2>{{$product->name}}</h2>
                    <div class="product-details-price">
                        <span>{{$product->getPrice()}} </span>
                        <span class="old">{{$product->getRealPrice()}}</span>
                    </div>
                    {{-- <div class="pro-details-rating-wrap">
                        <div class="pro-details-rating">
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                        </div>
                        <span><a href="#">3 Reviews</a></span>
                    </div> --}}
                    <p>{{$product->description}}</p>
                    {{-- <div class="pro-details-list">
                        <ul>
                            <li>- 0.5 mm Dail</li>
                            <li>- Inspired vector icons</li>
                            <li>- Very modern style </li>
                        </ul>
                    </div> --}}
                    <div class="pro-details-size-color d-none">
                        <div class="pro-details-color-wrap">
                            <span>Color</span>
                            <div class="pro-details-color-content">
                                <ul>
                                    <li class="blue"></li>
                                    <li class="maroon active"></li>
                                    <li class="gray"></li>
                                    <li class="green"></li>
                                    <li class="yellow"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pro-details-size">
                            <span>Size</span>
                            <div class="pro-details-size-content">
                                <ul>
                                    <li><a href="#">s</a></li>
                                    <li><a href="#">m</a></li>
                                    <li><a href="#">l</a></li>
                                    <li><a href="#">xl</a></li>
                                    <li><a href="#">xxl</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pro-details-quality">
                        <div class="cart-plus-minus">
                            <input value="{{$quantity}}" class="cart-plus-minus-box cart_update_data" id="cart_product_qty_{{$product->id}}" type="text" name="qtybutton" data-product_id="{{$product->id}}" data-url="{{route("web.shop.cart.update" , $product->id )}}">
                        </div>
                        @auth
                        <div class="pro-details-cart btn-hover">
                            <a title="{{$in_cart ? "Remove From Cart" : "Add To Cart"}}" data-product_id="{{$product->id}}" data-url="{{route("web.shop.cart.save" , $product->id )}}" class="btn-group cart_add_or_remove_btn">
                                <span class="spinner spinner-border spinner-border-sm d-none"></span>
                                <span class="label">
                                    {{$in_cart ? "Remove From Cart" : "Add To Cart"}}
                                </span>
                            </a>
                        </div>
                        @else
                        <a class="btn login_btn p-3" href="{{ route("login")}}" class="">Login</a>
                        @endauth
                        <div class="pro-details-wishlist">
                            @livewire("shop.wishlist-component" , ["product" => $product])
                        </div>
                    </div>

                    <div class="pro-details-meta">
                        <span>Categories :</span>
                        <ul>
                            <li><a href="#">{{ optional($product->category)->name }}</a></li>
                        </ul>
                    </div>
                    {{-- <div class="pro-details-meta">
                        <span>Tag :</span>
                        <ul>
                            <li><a href="#">Fashion, </a></li>
                            <li><a href="#">Furniture,</a></li>
                            <li><a href="#">Electronic</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="description-review-area pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="description-review-wrapper">
                    <div class="description-review-topbar nav">
                        <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                        <a data-bs-toggle="tab" href="#des-details3">Additional information</a>
                        {{-- <a data-bs-toggle="tab" href="#des-details2">Reviews (3)</a> --}}
                    </div>
                    <div class="tab-content description-review-bottom">
                        <div id="des-details1" class="tab-pane active">
                            <div class="product-description-wrapper">
                                <p>{{$product->description}}</p>
                            </div>
                        </div>
                        <div id="des-details3" class="tab-pane">
                            <div class="product-anotherinfo-wrapper">
                                <ul>
                                    <li><span>Weight</span> {{$product->weight ?? "N/A"}}</li>
                                    <li><span>Dimensions</span>{{$product->dimensions ?? "N/A"}}</li>
                                    <li><span>Materials</span> {{$product->materials ?? "N/A"}}</li>
                                    <li><span>Other Info</span>{{$product->other_info ?? "N/A"}}</li>
                                </ul>
                            </div>
                        </div>
                        <div id="des-details2" class="tab-pane">
                            <div class="review-wrapper">
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="{{$web_assets}}/images/product-details/client-1.jpg" alt="">
                                    </div>
                                    <div class="review-content">
                                        <p>“In convallis nulla et magna congue convallis. Donec eu nunc vel justo maximus posuere. Sed viverra nunc erat, a efficitur nibh”</p>
                                        <div class="review-top-wrap">
                                            <div class="review-name">
                                                <h4>Stella McGee</h4>
                                            </div>
                                            <div class="review-rating">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="{{$web_assets}}/images/product-details/client-2.jpg" alt="">
                                    </div>
                                    <div class="review-content">
                                        <p>“In convallis nulla et magna congue convallis. Donec eu nunc vel justo maximus posuere. Sed viverra nunc erat, a efficitur nibh”</p>
                                        <div class="review-top-wrap">
                                            <div class="review-name">
                                                <h4>Stella McGee</h4>
                                            </div>
                                            <div class="review-rating">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="single-review">
                                    <div class="review-img">
                                        <img src="{{$web_assets}}/images/product-details/client-3.jpg" alt="">
                            </div>
                            <div class="review-content">
                                <p>“In convallis nulla et magna congue convallis. Donec eu nunc vel justo maximus posuere. Sed viverra nunc erat, a efficitur nibh”</p>
                                <div class="review-top-wrap">
                                    <div class="review-name">
                                        <h4>Stella McGee</h4>
                                    </div>
                                    <div class="review-rating">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="ratting-form-wrapper">
                                <span>Add a Review</span>
                                <p>Your email address will not be published. Required fields are marked <span>*</span></p>
                                <div class="star-box-wrap">
                                    <div class="single-ratting-star">
                                        <i class="la la-star"></i>
                                    </div>
                                    <div class="single-ratting-star">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                    </div>
                                    <div class="single-ratting-star">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                    </div>
                                    <div class="single-ratting-star">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                    </div>
                                    <div class="single-ratting-star">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                    </div>
                                </div>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="rating-form-style mb-20">
                                                    <label>Your review <span>*</span></label>
                                                    <textarea name="Your Review"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style mb-20">
                                                    <label>Name <span>*</span></label>
                                                    <input type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style mb-20">
                                                    <label>Email <span>*</span></label>
                                                    <input type="email">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-submit">
                                                    <input type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="pro-dec-banner">
            <a href="#"><img src="{{$web_assets}}/images/banner/banner-4.png" alt=""></a>
        </div>
    </div>
</div>
</div>
</div>
@if (count($related_products) > 0)
<div class="product-area pb-100">
    @include("web.pages.home.fragments.list_products" , ["is_carousel" => true,
    "title" => "Related Products" , "sub_title" => "Subtitle goes here" , "products" => $related_products])
</div>
@endif
@endsection
@include("web.pages.shop.includes.cart_script")
