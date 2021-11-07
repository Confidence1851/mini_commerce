<?php

namespace App\Services\Shop\Order;

use App\Helpers\Constants;
use App\Models\Cart;
use App\Models\Order;
use App\Services\Shop\CartService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public static function create($data): Order
    {
        DB::beginTransaction();
        try{
        $validator = Validator::make($data, [
            "user_id" => "required|exists:users,id",
            "cart_id" => "required|exists:carts,id",
            "delivery_address_id" => "required|exists:delivery_addresses,id",
            "message" => "nullable|string",
            "payment_id" => "nullable|string",
            "coupon_id" => "nullable|string",
            "payment_method" => "required|string",
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = $validator->validated();

        $cart = Cart::where("id", $data["cart_id"])
            ->where("user_id", $data["user_id"])
            ->with("cartItems")
            ->first();

        $cartItems = $cart->cartItems;
        $cart = CartService::refreshCart($cart->id);

        $more = [
            "reference" => getRandomToken(8, true),
            "amount" => $cart->total,
            "discount" => $cart->discount,
            "status" => Constants::PENDING,
            "file" => null,
            "history" => null,
            "comment" => null,
        ];

        unset($data["cart_id"]);
        $order = Order::create(array_merge($data, $more));

        OrderItemsService::create($order , $cartItems);

        DB::commit();
        return $order;
    }catch(Exception $e){
        DB::rollback();
        throw $e;
    }

    }

}
