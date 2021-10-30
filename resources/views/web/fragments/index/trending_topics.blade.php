<!-- Start Categories List  -->
<div class="axil-categories-list axil-section-gap bg-color-grey">
    <div class="container">
        <div class="row align-items-center mb--30">
            <div class="col-lg-6 col-md-8 col-sm-8 col-12">
                <div class="section-title">
                    <h2 class="title">Trending Topics</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-4 col-12">
                <div class="see-all-topics text-left text-sm-right mt_mobile--20">
                    {{-- <a class="axil-link-button" href="#">See All Topics</a> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="list-categories categories-activation axil-slick-arrow arrow-between-side">

                   @foreach ($trendingTopics as $topic)
                    <div class="single-cat">
                        <div class="inner">
                            <a href="#">
                                <div class="thumbnail">
                                    <img src="{{ $topic->coverImageUrl() }}" alt="post categories images">
                                </div>
                                <div class="content">
                                    <h5 class="title">{{ $topic->name }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                   @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Categories List  -->
