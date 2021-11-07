<?php

namespace App\Services\Shop\Order;

use App\Models\Order;
use App\Models\OrderItem;

class OrderItemsService
{
    public static function create(Order $order , $cartItems)
    {

        foreach ($cartItems as $item) {
            $extra = [];

            if (!empty($key = $item->color) && $key != "undefined") {
                $extra["color"] = $key;
            }
            if (!empty($key = $item->size) && $key != "undefined") {
                $extra["color"] = $key;
            }

            if (empty($extra)) {
                $extra = null;
            }

            OrderItem::create([
                "order_id" => $order->id,
                "user_id" => $order->user_id,
                "product_id" => $item->product_id,
                "product_name" => $item->product->name,
                "unit_price" => $item->price,
                "discount" => $item->discount,
                "quantity" => $item->quantity,
                "total" => $item->total,
                "extra" => $extra
            ]);

            
        }

    }

}
