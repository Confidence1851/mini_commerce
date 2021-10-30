<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Services\Auth\AuthorizationService;
use Illuminate\Http\Request;

class ReferralsController extends Controller
{
    public function index(Request $request)
    {
        AuthorizationService::hasPermissionTo("can_read_referrals");
        $referrer_id = $request->referrer_id;

        $queryBuilder = Referral::whereHas("user")
            ->whereHas("referrer")
            ->with("user")
            ->with("referrer")
            ->orderby("created_at", "desc");

        if (!empty($referrer_id)) {
            $queryBuilder = $queryBuilder->where("referrer_id", $referrer_id);
        }

        $referrals = $queryBuilder->paginate(20)->appends($request->query());
        $sn = $referrals->firstItem();
        return view("dashboards.admin.referrals.index", compact('referrals', 'sn'));
    }
}
