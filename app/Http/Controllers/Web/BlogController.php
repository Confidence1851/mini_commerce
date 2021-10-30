<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Constants;
use App\Helpers\PageMetaData;
use App\Helpers\ShareActivityHelper;
use App\Helpers\SocialShareHelper;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;

        if (ucfirst($type) == Constants::BLOG) {
            $builder1 = Post::blog();
            $builder2 = Post::vlog();
        } else {
            $builder1 = Post::vlog();
            $builder2 = Post::blog();
        }

        $posts = $builder1->orderby("created_at", "desc")->paginate(10);
        $popularPosts = $builder1->orderby("views_count", "desc")->limit(5)->get();
        $vlog = $builder2->inRandomOrder()->first();

        $posts->appends($request->query());
        $breadcrumbData = $this->getBreadcrumbData($request);

        return view("web.pages.blog.index", array_merge([
            "searchKeyword" => "",
            "posts" => $posts,
            "popularPosts" => $popularPosts,
            "singlePost" => $vlog,
            "metaData" => PageMetaData::blogPage($type)
        ], $breadcrumbData));
    }


    public function search(Request $request)
    {
        $title = "";
        $searchKeyword = $request->search;
        $builder = Post::active();

        if (!empty($searchKeyword)) {
            $builder = $builder->search($searchKeyword);
        }

        if (!empty($key = $request->sponsored) && $key) {
            $builder = $builder->sponsored($key);
            $title .= "Sponsored";
        }

        if (!empty($key = $request->category)) {
            $builder = $builder->whereHas("category", function ($query) use ($key) {
                $query->where("name", $key);
            });
            $title .= $key;
        }

        $posts = $builder->orderby("created_at", "desc")->paginate(10);
        $popularPosts = Post::active()->orderby("views_count", "desc")->limit(5)->get();

        $posts->appends($request->query());
        $breadcrumbData = $this->getBreadcrumbData($request, $title);

        return view("web.pages.blog.index", array_merge([
            "searchKeyword" => $searchKeyword,
            "posts" => $posts,
            "popularPosts" => $popularPosts,
            "metaData" => PageMetaData::searchPage($title)
        ], $breadcrumbData));
    }

    public function getBreadcrumbData($request, $topTitle = null)
    {
        $title = ucfirst($request->type);
        $value = "";
        $searchKeyword = $request->search;

        if (!empty($topTitle)) {
            $title .= ucwords($topTitle) . " posts ";
        }

        if (!empty($searchKeyword)) {
            $title .= "Search result for: ";
            $value = "\"$searchKeyword\"";
        }

        if (empty($title)) {
            $title = "Search";
        }
        return [
            "breadcrumbTitle" => $title,
            "breadcrumbValue" => $value
        ];
    }


    public function details(Request $request, $uuid)
    {
        $post = Post::active()->findByUuid($uuid)->firstOrFail();
        $post->update(["views_count" => $post->views_count + 1]);
        $relatedPosts = Post::active()->relatedCategory($post->category_id)->inRandomOrder()->limit(9)->get();
        $moreStories = $relatedPosts->splice(5);
        $featuredVideos = Post::active()->vlog()->featured()->inRandomOrder()->limit(5)->get();

        if (
            !empty($sharer = $request->sharer)
            && $post->isSponsored()
            // && carbon()->parse($post->created_at)->isToday()
        ) {
            $shareActivityHandler = new ShareActivityHelper;
            $shareActivityHandler->onVisit($sharer, $post->id, $post->isSponsored());
        }

        return view(
            "web.pages.blog.details",
            [
                "post" => $post,
                "relatedPosts" => $relatedPosts,
                "moreStories" => $moreStories,
                "featuredVideos" => $featuredVideos,
                "metaData" => PageMetaData::blogDetailsPage($post)
            ]
        );
    }

    public function share(Request $request)
    {
        $post = Post::active()->findByUuid($request->uuid)->firstorFail();
        $platform = $request->platform;
        $shareHandler = new SocialShareHelper;
        $link = $shareHandler->getLink($platform, $post->detailsUrl(true));
        return redirect()->away($link);
    }
}
