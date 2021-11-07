<div class="product-wrap product-border-1">
    <div class="product-img">
        <a href="{{ $product->detailUrl() }}"><img src="{{ $product->getDefaultImage() }}" alt="product"></a>
    </div>
    <div class="product-content product-content-padding text-center">
        <h4><a href="{{ $product->detailUrl() }}">{{ $product->name }}</a></h4>
        {{-- <div class="product-rating">
            <i class="la la-star"></i>
            <i class="la la-star"></i>
            <i class="la la-star"></i>
            <i class="la la-star"></i>
            <i class="la la-star"></i>
        </div> --}}
        <div class="product-price">
            <span>{{ $product->getPrice() }}</span>
        </div>
    </div>
</div>

{{-- @include("web.pages.shop.fragments.product_modal") --}}
