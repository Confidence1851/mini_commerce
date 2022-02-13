<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Constants\AppConstants;
use App\Constants\ProductConstants;
use App\Helpers\Constants;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = ProductCategory::latest()
            ->paginate($request->pagination ?? AppConstants::PAGINATION_SIZE_WEB);
        return view("dashboards.admin.product_categories.index", [
            "categories" => $categories,
            "sn" => $categories->firstItem(),
            "statusOptions" => ProductConstants::STATUS_OPTIONS
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "category_id" => "nullable|exists:product_categories,id",
            "name" => "required|string|unique:product_categories,name",
            "status" => "required|string",
            "image" => "required|image",
        ]);

        if (!empty($file = $data["image"] ?? null)) {
            $data["image"] = putFileInPrivateStorage($file, "product_category_images");
        }

        ProductCategory::create($data);
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
        $category = ProductCategory::findOrFail($id);
        $boolOptions = Constants::BOOL_OPTIONS;
        return view("dashboards.admin.product_categories.show", [
            "category" => $category,
            "boolOptions" => $boolOptions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "category_id" => "nullable|exists:product_categories,id",
            "name" => "required|string|unique:product_categories,name,$id",
            "status" => "required|string",
            "image" => "nullable|image",
        ]);

        $category = ProductCategory::findOrFail($id);
        $old_image = null;
        if (!empty($file = $data["image"] ?? null)) {
            $data["image"] = putFileInPrivateStorage($file, "product_category_images");
            $old_image = $category->image;
        }
        $category->update($data);
        if (!empty($old_image)) {
            deleteFileFromPrivateStorage($old_image);
        }

        return back()->with("success_message", "Category updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        deleteFileFromPrivateStorage($category->image);
        $category->delete();
        return back()->with("success_message", "Category deleted successfully!");
    }
}
