<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Referral;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $count = Subscription::where("is_active" , Constants::ACTIVE)->count();
        $subscribedPlans = Subscription::where("is_active" , Constants::ACTIVE)
        ->selectRaw("plan_name ,
        count('plan_name') As plan_counts ,
        count('*') As total , (count('plan_name') * 100) / $count  as percentage ")
        ->groupBy("plan_name")
        ->orderby("plan_counts" , "desc")
        ->get();

        $newSignups = User::orderby("id" , "desc")
        ->whereHas("plan")->with("plan")
        ->limit(10)->get();

        $analytics = [
            "users" => [
                "count" => User::count(),
            ],
            "referrals" => [
                "count" => Referral::count(),
            ],
            "posts" => [
                "count" => Post::count(),
            ],
        ];
       return view("dashboards.admin.index.index" , [
           "analytics" => $analytics,
           "subscribedPlans" => $subscribedPlans,
           "newSignups" => $newSignups
       ]);
    }
}
