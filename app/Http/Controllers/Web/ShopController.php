<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Shop\CartItemService;


class ShopController extends Controller
{

    public function index()
    {
        $products = Product::paginate(20);
        return view("web.pages.shop.index", ["products" => $products]);
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
        return view("web.pages.shop.details", [
            "product" => $product,
            "related_products" => $related_product,
            "in_cart" => $in_cart, "quantity" => $quantity
        ]);
    }


}
