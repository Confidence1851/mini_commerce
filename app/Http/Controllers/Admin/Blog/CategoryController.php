<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Helpers\Constants;
use App\Helpers\MediaHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Services\Auth\AuthorizationService;

class CategoryController extends Controller
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
    public function index()
    {
        AuthorizationService::hasPermissionTo("can_read_post_categories");
        $categories = PostCategory::with("posts")->orderBy('id', 'desc')->paginate(20);
        $sn = $categories->firstItem();
        $boolOptions = [
            Constants::ACTIVE => "Yes",
            Constants::INACTIVE => "No",
        ];
        return view(
            'dashboards.admin.category.index',
            [
                'sn' => $sn,
                'categories' => $categories,
                "boolOptions" => $boolOptions,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = PostCategory::where("is_active", Constants::ACTIVE)->get();
        $types = [Constants::BLOG, Constants::VLOG];
        $boolOptions = [
            Constants::ACTIVE => "Yes",
            Constants::INACTIVE => "No",
        ];

        return view(
            "dashboards.admin.category.create",
            [
                "postCategories" => $postCategories,
                "types" => $types,
                "boolOptions" => $boolOptions,

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
        AuthorizationService::hasPermissionTo("can_create_post_categories");
        $data = $request->validate([
            "name" => "required|string|unique:post_categories,name",
            "is_trending" => "required|in:0,1",
            "is_active" => "required|in:0,1",
            "cover_image" => "required|image",
            "show_on_dashboard" => "required|string",
            "accessible_plans" => "required|string"
        ]);

        if (!empty($cover_image = $request->file("cover_image"))) {
            $coverImageFile = $this->saveCoverImage($cover_image, null);
            $data["cover_image"] = $coverImageFile->id;
        }
        PostCategory::create($data);
        return back()->with("success_message", "Category created successfully!");
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
    public function edit(PostCategory $category)
    {
        AuthorizationService::hasPermissionTo("can_edit_post_categories");
        $boolOptions = [
            Constants::ACTIVE => "Yes",
            Constants::INACTIVE => "No",
        ];
        return view("dashboards.admin.category.edit", [
            "category" => $category, "boolOptions" => $boolOptions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $category)
    {
        AuthorizationService::hasPermissionTo("can_edit_post_categories");
        $data = $request->validate([
            "name" => "required|string|unique:post_categories,name,$category->id",
            "is_trending" => "required|string|in:0,1",
            "is_active" => "required|string|in:0,1",
            "cover_image" => "nullable|image",
            "show_on_dashboard" => "required|string",
            "accessible_plans" => "required|string"
        ]);
        if (!empty($cover_image = $request->file("cover_image"))) {
            $coverImageFile = $this->saveCoverImage($cover_image, $category->cover_image);
            $data["cover_image"] = $coverImageFile->id;
        }
        $category = $category->update($data);
        return back()->with("success_message", "Changes saved successfully!");
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $category)
    {
        AuthorizationService::hasPermissionTo("can_delete_post_categories");
        optional($category->coverImage)->cleanDelete();
        $category->delete();
        return back()->with("error_message", "Deleted successfully!");
    }


    public function saveCoverImage($cover_image, $cover_image_id = null)
    {
        $user = auth()->user();
        $filePath = putFileInPrivateStorage($cover_image, "temp");
        return $this->mediaHandler->saveFromFilePath(storage_path("app/$filePath"), "post_categories", $cover_image_id, $user->id);
    }

}
