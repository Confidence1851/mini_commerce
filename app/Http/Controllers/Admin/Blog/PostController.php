<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Helpers\Constants;
use App\Helpers\MediaHandler;
use App\Helpers\PostHandler;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\QueryBuilder\PostQueryBuilder;
use App\Services\Auth\AuthorizationService;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public $mediaHandler;
    public function __construct(MediaHandler $mediaHandler)
    {
        $this->mediaHandler = $mediaHandler;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        AuthorizationService::hasPermissionTo("can_read_posts");
        $query = $request->query();
        $posts = PostQueryBUilder::filterIndex($request)->orderby("id", "desc")->paginate(20);
        $posts->appends($query);
        $sn = $posts->firstItem();
        $boolOptions = Constants::BOOL_OPTIONS;
        $postCategories = PostCategory::where("is_active", Constants::ACTIVE)->get();
        $types = [Constants::BLOG, Constants::VLOG];
        return view("dashboards.admin.posts.index", [
            "posts" => $posts,
            "sn" => $sn, "boolOptions" => $boolOptions,
            "postCategories" => $postCategories,
            "query" => $query,
            "types" => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        AuthorizationService::hasPermissionTo("can_create_posts");
        $postCategories = PostCategory::where("is_active", Constants::ACTIVE)->get();
        $types = [Constants::BLOG, Constants::VLOG];
        $boolOptions = Constants::BOOL_OPTIONS;
        return view(
            "dashboards.admin.posts.create",
            [
                "postCategories" => $postCategories,
                "types" => $types,
                "boolOptions" => $boolOptions
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AuthorizationService::hasPermissionTo("can_create_posts");
        $data = $this->validateData($request);
        $user = auth()->user();
        $data = $this->saveCoverMedia($request, $user->id, $data, new Post);
        $data = array_merge([
            "uuid" => Post::getUuid(),
            "author_id" => $user->id,
        ], $data);
        Post::create($data);
        return back()->with("success_message", "Post saved successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // dd($post->body);
        AuthorizationService::hasPermissionTo("can_edit_posts");
        $postCategories = PostCategory::where("is_active", Constants::ACTIVE)->get();
        $types = [Constants::BLOG, Constants::VLOG];
        $boolOptions = Constants::BOOL_OPTIONS;
        return view(
            "dashboards.admin.posts.edit",
            [
                "post" => $post,
                "postCategories" => $postCategories,
                "types" => $types,
                "boolOptions" => $boolOptions
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        AuthorizationService::hasPermissionTo("can_edit_posts");
        $data = $this->validateData($request, $post->id);
        $user = auth()->user();
        $data = $this->saveCoverMedia($request, $user->id, $data, $post);

        $post->update($data);
        return back()->with("success_message", "Post saved successfully!");
    }

    public function saveCoverMedia(Request $request, $user_id, array $data, Post $post)
    {
        if (!empty($cover_image = $request->file("cover_image"))) {
            $filePath = putFileInPrivateStorage($cover_image, "temp");
            $coverImageFile = $this->mediaHandler
                ->saveFromFilePath(storage_path("app/$filePath"), "post_images", $post->cover_image ?? null, $user_id);
            $data["cover_image"] = $coverImageFile->id;
        }

        if (!empty($cover_video = $request->file("cover_video"))) {
            $filePath = putFileInPrivateStorage($cover_video, "temp");
            $coverVideoFile = $this->mediaHandler
                ->saveFromFilePath(storage_path("app/$filePath"), "post_videos", $post->cover_video ?? null, $user_id);
            $data["cover_video"] = $coverVideoFile->id;
        }

        return $data;
    }

    public function validateData(Request $request, $post_id = null)
    {
        $allowedOptions = Constants::ACTIVE . "," . Constants::INACTIVE;
        $allowedTypes = Constants::BLOG . "," . Constants::VLOG;
        $cover = empty($post_id) ? "required" : "";
        return $request->validate([
            "category_id" => "required|string|exists:post_categories,id",
            "type" => "required|string|in:$allowedTypes",
            "title" => "required|string|unique:posts,title,$post_id",
            "body" => "required|string|min:10",
            "is_sponsored" => "required|string|in:$allowedOptions",
            "is_top_story" => "required|string|in:$allowedOptions",
            "is_featured" => "required|string|in:$allowedOptions",
            "is_published" => "required|string|in:$allowedOptions",
            "can_comment" => "required|string|in:$allowedOptions",
            "meta_title" => "required|string",
            "meta_keywords" => "required|string",
            "meta_description" => "required|string",
            "cover_image" => "image",
            "cover_video" => "mimes:mp4,ogx,oga,ogv,ogg,webm",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        AuthorizationService::hasPermissionTo("can_delete_posts");
        $postHandler = new PostHandler;
        $postHandler->cleanDelete($post);
        return back()->with("success_message", "Deleted successfully!");
    }
}
