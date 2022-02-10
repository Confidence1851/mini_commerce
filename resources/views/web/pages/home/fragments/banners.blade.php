<div class="banner-area pt-20 pb-70 padding-10-row-col">
    <div class="container-fluid">
        <div class="row">
            @foreach ($banners as $banner)
            <div class="col-lg-4 col-md-4">
                <div class="banner-wrap mb-30">
                    <a href="{{$banner["link"]}}"><img class="animated" src="{{ $banner["image_url"] }}" alt="Product category"></a>
                    <div class="banner-content banner-position-1">
                        <h3>{!! $banner["title"] !!} </h3>
                        <div class="banner-btn">
                            <a href="{{$banner["link"]}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
