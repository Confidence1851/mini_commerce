<?php

namespace App\Services\Shop;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartService
{

    public static function getCartByUser($user_id): Cart
    {
        return Cart::firstOrCreate(
            ["user_id" => $user_id],
            [
                "reference" => self::generateReferenceNo(),
                "price" => 0,
                "discount" => 0,
                "total" => 0,
                "items" => 0,
            ]
        );
    }

    public static function generateReferenceNo()
    {
        $key = "RF_" . getRandomToken(8, true);
        $check = Cart::where("reference", $key)->count();
        if ($check > 0) {
            return self::generateReferenceNo();
        }
        return $key;
    }

    public static function addToCart($user_id, $product_id, array $data)
    {

        DB::beginTransaction();
        $cart = self::getCartByUser($user_id);
        CartItemService::saveToCart($cart->id, $product_id, $data);

        $cart = self::refreshCart($cart->id);
        DB::commit();
        return $cart;
    }

    public static function removeFromCart($user_id, $product_id)
    {
        DB::beginTransaction();
        $cart = self::getCartByUser($user_id);
        CartItemService::removeFromCart($cart->id, $product_id);
        $cart = self::refreshCart($cart->id);


        DB::commit();
        return $cart;
    }

    public static function refreshCart($cart_id)
    {
        $cart = self::getById($cart_id);

        CartItem::where("cart_id", $cart->id)->whereHas("product", function ($product) {
            $product->inactive();
        })->delete();

        $sums = CartItem::where("cart_id", $cart->id)
            ->whereHas("product")
            ->select(
                DB::raw("count(*) as count"),
                DB::raw("SUM(price) as total_price"),
                DB::raw("SUM(total) as total"),
                DB::raw("SUM(discount) as total_discount")
            )->first()->toArray();

        $data = [
            "items" => $sums["count"] ?? 0,
            "price" => $sums["total_price"] ?? 0,
            "discount" => $sums["total_discount"] ?? 0,
            "total" => $sums["total"] ?? 0
        ];



        $cart->update($data);
        return $cart->refresh();
    }

    public static function getById($cart_id): Cart
    {
        return Cart::find($cart_id);
    }
}
