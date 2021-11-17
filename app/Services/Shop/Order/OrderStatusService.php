<?php

namespace App\Services\Shop\Order;

use App\Constants\OrderActivityConstants;
use App\Constants\StatusConstants;
use App\Exceptions\Shop\OrderException;
use App\Models\Order;
use App\Services\Notifications\AppMailerService;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderStatusService
{

    public static function setStatus($order_id, $status, $message = null)
    {
        if (!in_array($status, array_keys(OrderActivityConstants::STATUS_OPTIONS))) {
            throw new OrderException("Invalid status provided.");
        }

        $order = OrderService::getById($order_id);
        $old_status = $order->status;

        if (in_array($status, [StatusConstants::PROCESSING, StatusConstants::PENDING])) {
            $order->update([
                "status" => $status,
            ]);
        }

        if ($status == StatusConstants::COMPLETED) {
            self::markAsComplete($order);
        }
        if ($status == StatusConstants::CANCELLED) {
            self::markAsCancelled($order, $message);
        }

        $actor = auth()->user();

        $activity_message = "Status was changed from $old_status to $status";
        if (!empty($message)) {
            $activity_message .= " with message \"$message\" ";
        }



        OrderActivityService::recordActivity(
            $order->id,
            $actor->id,
            $actor->names(),
            OrderActivityConstants::UPDATE_STATUS,
            $activity_message
        );
    }

    private static function markAsComplete(Order $order)
    {
        DB::beginTransaction();
        try {
            if ($order->payment->status == StatusConstants::PENDING) {
                $order->payment()->update([
                    "status" => StatusConstants::CONFIRMED,
                    "confirmed_at" => now(),
                    "admin_id" => auth()->id()
                ]);
            }

            $order->items()->update([
                "status" => 1
            ]);

            AppMailerService::send([
                "data" => [
                    "user" => $order->user,
                    "reference" => $order->reference,
                ],
                "to" => $order->user->email,
                "template" => "emails.orders.complete",
                "subject" => "Order Completed #$order->reference",
            ]);

            $order->update([
                "status" => StatusConstants::COMPLETED,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    private static function markAsCancelled(Order $order, $message)
    {
        AppMailerService::send([
            "data" => [
                "user" => $order->user,
                "reference" => $order->reference,
                "message" => $message
            ],
            "to" => $order->user->email,
            "template" => "emails.orders.cancelled",
            "subject" => "Order Cancelled #$order->reference",
        ]);

        $order->update([
            "status" => StatusConstants::CANCELLED,
            "message" => $message
        ]);
    }
}
