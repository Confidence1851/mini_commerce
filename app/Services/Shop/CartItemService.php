<?php

namespace App\Services\Shop;

use App\Models\CartItem;
use App\Models\Product;

class CartItemService
{


    public static function saveToCart($cart_id, $product_id, array $data)
    {
        $product = Product::find($product_id);
        $quantity = $data["quantity"] ?? 1;
        $data["price"] = $product->price  * $quantity;
        $data["discount"] = ($product->discount ?? 0)  * $quantity;
        $data["total"] =  ($data["price"] - $data["discount"]);

        return CartItem::updateOrCreate(
            [
                "cart_id" => $cart_id,
                "product_id" => $product_id
            ],
            $data
        );
    }

    public static function inCart($user_id, $product_id)
    {
        return CartItem::whereHas("cart", function ($query) use ($user_id) {
            $query->where("user_id", $user_id);
        })->where(
            [
                "product_id" => $product_id
            ],
        )->first();
    }

    public static function removeFromCart($cart_id, $product_id)
    {
        return CartItem::where(
            [
                "cart_id" => $cart_id,
                "product_id" => $product_id
            ]

        )->delete();
    }
}
