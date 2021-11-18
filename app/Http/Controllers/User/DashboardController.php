<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view("dashboards.user.dashboard" , ["user" => auth()->user()]);
    }


    public function orders(Request $request)
    {
        $user = auth()->user();
        $orders = Order::where("user_id" , $user->id)->latest()->paginate();
        return view("dashboards.user.orders" , ["orders" => $orders]);
    }

    public function orderDetails($id){

       $orderDetails = Order::where('id', $id)->find($id);
        return view('dashboards.user.orderdetails',['orderDetails'=>$orderDetails]);
    }

    public function payments(Request $request)
    {
        $user = auth()->user();
        $payments = Payment::where("user_id" , $user->id)->latest()->paginate();
        return view("dashboards.user.payments" , ["payments" => $payments]);
    }

    public function transactions()
    {
        $user = auth()->user();
        $transactions = $user->transactions()

            ->paginate(20);
        return view("dashboards.user.transactions", ["transactions" => $transactions]);
    }




}
