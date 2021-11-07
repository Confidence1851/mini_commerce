<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAddress;
use App\Services\Shop\DeliveryAddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{


    public function address(Request $request)
    {
        $user = auth()->user();
        $address = DeliveryAddress::where("user_id" , $user->id)->latest()->first();

        if ($request->getMethod() == "GET") {
            return view("dashboards.user.delivery_address" , ["user" => $user , "address" => $address]);
        }

        $request["user_id"] = $user->id;
        DeliveryAddressService::save($request->all());
        return redirect()->back()->with("success_message", "Delivery address saved successfully");
    }


    public function account(Request $request)
    {
        $user = auth()->user();

        if ($request->getMethod() == "GET") {
            return view("dashboards.user.account" , ["user" => $user]);
        }

        $user->update($request->all());
        return redirect()->back()->with("success_message", "Account updated successfully");
    }


    public function change_password(Request $request)
    {

        if ($request->getMethod() == "GET") {
            return view("dashboards.user.password");
        }

        $request->validate([
            "old_password" => "required|string",
            "new_password" => "required|string",
        ]);

        $user = auth()->user();
        if(!Hash::check($request->old_password, $user->password)){
            return redirect()->back()->with("error_message", "The old password is incorrect");
        }
        $user->update([
            "password" => Hash::make($request->new_password)
        ]);
        return redirect()->back()->with("success_message", "Password updated successfully");
    }

}
