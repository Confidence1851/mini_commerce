<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Constants\OrderActivityConstants;
use App\Exceptions\Shop\OrderException;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Shop\Order\OrderActivityService;
use App\Services\Shop\Order\OrderStatusService;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $builder = Order::with(["user", "payment"]);
        $message = $request->message ?? "Order not found";

        if(!empty($key = $request->search)){
            $builder = $builder->search($key);
        }

        if(!empty($key = $request->user_id)){
            $builder = $builder->where("user_id" , $key);
        }

        $orders = $builder->latest()->paginate();
        return view("dashboards.admin.orders.index", [
            "orders" => $orders,
            "message" => $message
        ]);
    }


    public function show($id)
    {
        $order = Order::with(["user", "payment", "items", "deliveryAddress"])->findOrFail($id);
        return view("dashboards.admin.orders.show", [
            "order" => $order,
            "histories" => OrderActivityService::parseHistory($order->history),
            "statusOptions" => OrderActivityConstants::STATUS_OPTIONS
        ]);
    }


    public function updateStatus(Request $request)
    {
        try {
            $request->validate([
                "order_id" => "required|exists:orders,id",
                "status" => "string|required",
                "message" => "string|nullable",
            ]);

            OrderStatusService::setStatus($request->order_id, $request->status, $request->message);
            return back()->with("success_message", "Changes saved successfully!");
        } catch (OrderException $e) {
            return back()->with("error_message", $e->getMessage());
        } catch (Exception $e) {
            return back()->with("error_message", "An error occured while processing your request");
        }
    }

}
