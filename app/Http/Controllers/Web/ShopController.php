<?php

namespace App\Http\Controllers\Web;

use App\Constants\ProductConstants;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Helpers\PageMetaData;
use App\QueryBuilder\ShopQueryBuilder;
use App\Services\Shop\CartItemService;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function index(Request $request)
    {


        $message = $request->message ?? "Result not found, try searching for another keyword";
        $products = ShopQueryBuilder::filterIndex($request->all())->paginate(25);
        return view("web.pages.shop.index", [
            "products" => $products,
            'message' => $message,
            'orderByOptions' => ProductConstants::SHOP_ORDER_OPTIONS,
            "metaData" => PageMetaData::shopPage()
        ]);
    }

    public function details($id)
    {

        $in_cart = false;
        $quantity = 1;
        $product = Product::findOrFail($id);
        $related_product = Product::where("category_id", $product->category_id)->whereNotIn("id", [$product->id])->limit(10)->get();

        if (auth()->check()) {
            $user = auth()->user();
            $cart_item = CartItemService::inCart($user->id, $product->id);
            if ($cart_item) {
                $quantity = $cart_item->quantity;
                $in_cart = true;
            }
        }
        $product->increment("total_views");

        return view("web.pages.shop.details", [
            "product" => $product,
            "related_products" => $related_product,
            "in_cart" => $in_cart, "quantity" => $quantity,
            "metaData" => PageMetaData::productDetailsPage($product)
        ]);
    }
}
