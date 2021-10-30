<!-- Start Post Grid  -->
<div class="content-block post-grid post-grid-transparent">
    <div class="post-thumbnail">
        <a href="post-details.html">
            <img class="bg_image" data-width="600" data-height="600" data-image="{{ $post->coverImageUrl() }}" >
        </a>
    </div>
    {{-- <div class="post-grid-content">
        <div class="post-content">
            <div class="post-cat">
                <div class="post-cat-list">
                    <a class="hover-flip-item-wrapper" href="#">
                        <span class="hover-flip-item">
                            <span data-text="{{ $post->category->name }}">{{ $post->category->name }}</span>
                        </span>
                    </a>
                </div>
            </div>
            <h3 class="title"><a href="{{ $post->detailsUrl() }}">{{ str_limit($post->title, 50) }}</a></h3>
        </div>
    </div> --}}
</div>
<!-- Start Post Grid  -->
