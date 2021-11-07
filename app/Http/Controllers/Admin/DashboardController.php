<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $latest_users = User::latest()->limit(10)->get();
        $latest_orders = Order::latest()->limit(10)->get();

        $analytics = [
            "users" => [
                "count" => User::count(),
            ],
            "products" => [
                "count" => Product::count(),
            ],
            "orders" => [
                "count" => Order::count(),
            ],
        ];
       return view("dashboards.admin.index.index" , [
           "analytics" => $analytics,
           "latest_users" => $latest_users,
           "latest_orders" => $latest_orders
       ]);
    }
}
