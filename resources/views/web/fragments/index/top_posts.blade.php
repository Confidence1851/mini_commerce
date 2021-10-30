<div class="axil-tech-post-banner pt--30 bg-color-grey">
    <div class="container">
        <div class="row">
            <div class="row">

                <div class="col-xl-6 col-md-12 col-12">
                   @include("web.fragments.index.big_top_post" , ["post" => $topPosts[0] ])
                </div>

                <div class="col-xl-3 col-md-6 mt_lg--30 mt_md--30 mt_sm--30 col-12">
                   @include("web.fragments.index.small_top_post", ["post" => $topPosts[1] , "class" => ""])
                   @include("web.fragments.index.small_top_post", ["post" => $topPosts[2] , "class" => "mt--30"])
                </div>
                <div class="col-xl-3 col-md-6 mt_lg--30 mt_md--30 mt_sm--30 col-12">
                    @include("web.fragments.index.small_top_post", ["post" => $topPosts[3] , "class" => ""])
                    @include("web.fragments.index.small_top_post", ["post" => $topPosts[4] , "class" => "mt--30"])
                </div>
            </div>
        </div>
    </div>
</div>
