<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Constants;
use App\Helpers\PageMetaData;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\Vendor;

class IndexController extends Controller
{
    public function index()
    {
       $proucts = Product::limit(12)->inRandomOrder()->get();

        return view("web.pages.home.index", [
            "products" => $proucts,
            "metaData" => PageMetaData::indexPage()
        ]);
    }
    public function contact_us()
    {
        return view("web.pages.contact", [
            "metaData" => PageMetaData::contactPage()
        ]);
    }
    public function about()
    {
        return view("web.pages.about", [
            "metaData" => PageMetaData::about()
        ]);
    }


    /** Read a file via url */
    public function read_file($path)
    {
        return getFileFromPrivateStorage(readFileUrl("decrypt", $path));
    }

    public function approved_vendors()
    {
        $vendors = Vendor::approved()->whereHas("user")
            ->with("user")
            ->whereHas("coupons" , function ($query)
            {
                $query->whereNull("used_on");
            })
            ->with("coupons")
            ->orderby("created_at", "desc")
            ->paginate(20);
        $sn = $vendors->firstItem();
        $plans = Plan::active()->where("price", ">", 0)->get(["name", "price"]);
        return view("web.pages.approved_vendors", ["vendors" => $vendors, "sn" => $sn, "plans" => $plans]);
    }
}
