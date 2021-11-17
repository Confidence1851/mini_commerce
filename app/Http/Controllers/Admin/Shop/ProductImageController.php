<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Constants\ProductConstants;
use App\Helpers\Constants;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "product_id" => "required|exists:products,id",
            "image" => "required|image",
            "is_default" =>  "required|string|in:0,1",
        ]);

        if (!empty($file = $data["image"] ?? null)) {
            $data["image"] = putFileInPrivateStorage($file, "product_images");
        }
        $image = ProductImage::create($data);

        if ($image->is_default == 1) {
            ProductImage::whereNotIn("id", [$image->id])
                ->where("product_id", $image->product_id)
                ->update([
                    "is_default" => 0
                ]);
        }
        return back()->with("success_message", "Product image created successfully");
    }

    public function update(Request $request, $id)
    {
        $image = ProductImage::findOrFail($id);
        $old_image = null;
        $data = $request->validate([
            "product_id" => "required|exists:products,id",
            "image" => "nullable|image",
            "is_default" =>  "required|string|in:0,1",
        ]);

        if (!empty($file = $data["image"] ?? null)) {
            $data["image"] = putFileInPrivateStorage($file, "product_images");
            $old_image = $image->image;
        }

        $image->update($data);

        if (!empty($old_image)) {
            deleteFileFromPrivateStorage($old_image);
        }

        $image->refresh();

        if ($image->is_default == 1) {
            ProductImage::whereNotIn("id", [$image->id])
                ->where("product_id", $image->product_id)
                ->update([
                    "is_default" => 0
                ]);
        }
        return back()->with("success_message", "Product image updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductImage::findOrFail($id)->delete();
        return back()->with("success_message", "Image deleted successfully!");
    }
}
