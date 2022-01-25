<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Constants\ProductConstants;
use App\Helpers\Constants;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\Shop\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(["defaultImage", "category"])->latest()->paginate();
        $sn = $products->firstItem();
        return view("dashboards.admin.products.index", [
            "products" => $products,
            "sn" => $sn
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;
        $categories = ProductCategory::get();

        return view("dashboards.admin.products.create", [
            "product" => $product,
            "categories" => $categories,
            "statusOptions" => ProductConstants::STATUS_OPTIONS
        ]);
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
            "category_id" => "required|exists:product_categories,id",
            "name" => "required|string",
            "description" =>  "required|string",
            "price" =>  "required|gt:0",
            "discount" =>  "nullable|gt:0",
            "status" =>  "required|string",
        ]);
        $data["reference"] = ProductService::generateReference();
        $product = Product::create($data);
        return redirect()->route("admin.products.show" , $product->id)->with("success_message", "Product created successfully. Kindly add images for the product!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(["category", "images"])->findOrFail($id);
        return view("dashboards.admin.products.show", [
            "product" => $product,
            "boolOptions" => Constants::BOOL_OPTIONS
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
        $product = Product::findOrFail($id);
        $categories = ProductCategory::get();

        return view("dashboards.admin.products.edit", [
            "product" => $product,
            "categories" => $categories,
            "statusOptions" => ProductConstants::STATUS_OPTIONS
        ]);
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
            "category_id" => "required|exists:product_categories,id",
            "name" => "required|string",
            "description" =>  "required|string",
            "price" =>  "required|gt:0",
            "discount" =>  "nullable|gt:0",
            "status" =>  "required|string",
        ]);
        Product::findOrFail($id)->update($data);
        return back()->with("success_message", "Changes saved successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // foreach($product->images as $image){
        //     $image->cleanDelete();
        // }
        $product->delete();
        return back()->with("success_message", "Product deleted successfully!");
    }


    public function orders(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $orderItems = OrderItem::whereHas("order")
        ->with(["order" , "order.payment"])
        ->where("product_id" , $product->id)->paginate()
        ->appends($request->query());
        return view("dashboards.admin.products.orders", [
            "sn" => $orderItems->firstItem(),
            "product" => $product,
            "orderItems" => $orderItems
        ]);
    }
}
