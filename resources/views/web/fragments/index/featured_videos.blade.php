<div class="axil-video-post-area axil-section-gap bg-color-black">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2 class="title">Featured Video</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if (!empty(($post = $posts[0] ?? null)))
                <div class="col-xl-6 col-lg-6 col-md-12 col-md-6 col-12">
                    @include("web.fragments.index.video_info" , ["post" => $post , "withMeta" => true , "size" => "large"])
                </div>
            @endif
            <div class="col-xl-6 col-lg-6 col-md-12 col-md-6 col-12">
                <div class="row">
                    @if (!empty(($post = $posts[1] ?? null)))
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            @include("web.fragments.index.video_info" , ["post" => $post , "withMeta" => false , "size" => "medium"])
                        </div>
                    @endif
                    @if (!empty(($post = $posts[2] ?? null)))
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            @include("web.fragments.index.video_info" , ["post" => $post , "withMeta" => false , "size" => "medium"])
                        </div>
                    @endif
                    @if (!empty(($post = $posts[3] ?? null)))
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            @include("web.fragments.index.video_info" , ["post" => $post , "withMeta" => false , "size" => "medium"])
                        </div>
                    @endif
                    @if (!empty(($post = $posts[4] ?? null)))
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            @include("web.fragments.index.video_info" , ["post" => $post , "withMeta" => false , "size" => "medium"])
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
