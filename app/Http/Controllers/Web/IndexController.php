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
use App\Services\Auth\AuthorizationService;

class IndexController extends Controller
{

    public function index()
    {

        $proucts = Product::whereHas("defaultImage")
            ->with("defaultImage")
            ->limit(12)->inRandomOrder()->get();

        return view("web.pages.home.index", [
            "products" => $proucts,
            "banners" => [
                [
                    "image_url" => my_asset("web/images/banner/banner-1.png"),
                    "link" => route("web.shop.index", ["category_id" => 1]),
                    "title" => "Fashionable <br>ladies Bag"
                ],
                [
                    "image_url" => my_asset("web/images/banner/banner-2.png"),
                    "link" => route("web.shop.index", ["category_id" => 1]),
                    "title" => "Dj Fashion <br> Man Shoes"
                ],
                [
                    "image_url" => my_asset("web/images/banner/banner-3.png"),
                    "link" => route("web.shop.index", ["category_id" => 1]),
                    "title" => "Super Kids <br> Ghost Hat"
                ],
            ],

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
}
