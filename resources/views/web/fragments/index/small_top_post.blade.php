 <!-- Start Single Post  -->
 <div class="content-block image-rounded {{ $class ?? "" }}">
    <div class="post-thumbnail">
        <a href="post-details.html">
            <img class="bg_image" data-width="285" data-height="190" data-image="{{ $post->coverImageUrl() }}" >
        </a>
    </div>
    {{-- <div class="post-content pt--20">
        <div class="post-cat">
            <div class="post-cat-list">
                <a class="hover-flip-item-wrapper" href="#">
                    <span class="hover-flip-item">
                        <span data-text="{{ $post->category->name }}">{{ $post->category->name }}</span>
                    </span>
                </a>
            </div>
        </div>
        <h5 class="title"><a href="{{ $post->detailsUrl() }}">{{ str_limit($post->title, 50) }}</a></h5>
    </div> --}}
</div>
<!-- End Single Post  -->
