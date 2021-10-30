<?php

namespace App\Http\Controllers\User;

use App\Helpers\Constants;
use App\Helpers\Wallet;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Referral;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {

    }



    public function transactions()
    {
        $user = auth()->user();
        $transactions = $user->transactions()

            ->paginate(20);
        return view("dashboards.user.transactions", ["transactions" => $transactions]);
    }

    


}
