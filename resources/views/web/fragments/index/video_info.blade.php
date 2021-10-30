<div class="content-block post-default image-rounded mt--30">
    <div class="post-thumbnail">
        <a href="{{ $post->detailsUrl() }}">
            <img src="{{ $post->coverImageUrl() }}" alt="Post Images">
        </a>
        <a class="video-popup {{$size ?? ""}} position-top-center" href="{{ $post->detailsUrl() }}"><span class="play-icon"></span></a>
    </div>
    <div class="post-content">
        <div class="post-cat">
            <div class="post-cat-list">
                <a class="hover-flip-item-wrapper" href="{{ $post->categoryUrl() }}">
                    <span class="hover-flip-item">
                        <span data-text="{{ $post->categoryName() }}">{{ $post->categoryName() }}</span>
                    </span>
                </a>
            </div>
        </div>
        <{{$size == "medium" ? "h5" : "h3"}} class="title"><a href="{{ $post->detailsUrl() }}">{{ $post->title }}</a></{{$size == "medium" ? "h5" : "h3"}}>
        @if ($withMeta ?? false)
            @include("web.pages.blog.fragments.details.post_meta" , ["post" => $post , "withImage" => false])
        @endif
    </div>
</div>
