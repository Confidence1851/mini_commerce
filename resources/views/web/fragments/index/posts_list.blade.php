<div class="axil-post-list-area post-listview-visible-color axil-section-gap bg-color-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-8">
                @include("web.pages.blog.fragments.sidebar.ads_banner1")
                @foreach ($posts as $key => $post)
                    @include("web.pages.blog.fragments.index.post_item" , ["post" => $post])
                @endforeach
            </div>
            <div class="col-lg-4 col-xl-4 mt_md--40 mt_sm--40">
                <div class="sidebar-inner">
                    @include("web.pages.blog.fragments.sidebar.search")
                    @include("web.pages.blog.fragments.sidebar.ads_banner")

                    @include("web.pages.blog.fragments.sidebar.stay_in_touch")


                </div>
            </div>
        </div>
    </div>
</div>
