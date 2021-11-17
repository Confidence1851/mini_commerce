<?php

namespace App\Services\Shop\Order;

class OrderActivityService
{
    public static function recordActivity($order_id, $actor_id , $actor_name , $action , $message )
    {
        $data = [
            "actor_id" => $actor_id,
            "actor_name" => $actor_name,
            "action" => $action,
            "message" => $message,
            "timestamp" => now(),
        ];

        $order = OrderService::getById($order_id);
        $history = self::parseHistory($order->history);
        $history[] = $data;
        $order->update([
            "history" => json_encode($history)
        ]);
    }


    public static function parseHistory($history)
    {
        return !empty($history) ? json_decode($history , true) : [];
    }

}
