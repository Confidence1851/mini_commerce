<div class="product-area pt-100 pb-100">
    <div class="container">
        <div class="section-title text-center mb-45">
            @if (!empty($title))
            <h2>{{$title}}</h2>

            @endif
            @if (!empty($sub_title))
            <p>{{$sub_title}}</p>
            @endif
        </div>
        @if ($is_carousel ?? false)
        <div class="product-slider-active owl-carousel">
            @foreach ($products as $product)
            @include("web.pages.shop.fragments.single_product")
            @endforeach
        </div>
        @else
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                @include("web.pages.shop.fragments.single_product")
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>
