<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CouponCode;
use App\QueryBuilder\CouponQueryBuilder;
use App\Services\Auth\AuthorizationService;

class CouponController extends Controller
{
    public function index(Request $request) {
        AuthorizationService::hasPermissionTo("can_read_coupons");
        $coupons = CouponQueryBuilder::filterIndex($request)->paginate(50)->appends($request->query());
        $sn = $coupons->firstItem();
        return view("dashboards.admin.coupons.index", ["coupons" => $coupons , "sn" => $sn ]);
    }
}
