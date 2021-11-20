<?php

namespace App\Http\Controllers\Web;

use App\Constants\StatusConstants;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Exceptions\Shop\ProductException;
use App\Helpers\PageMetaData;
use Exception;
use App\Services\Shop\CartItemService;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ShopController extends Controller
{

    // public $orderByOptions =[
    //     'created_at_latest' => 'Sort by - Newness',
    //     'asc' => 'A-Z',
    //     'desc' => 'Z-A',
    //    StatusConstants::ACTIVE => 'In stock'
    // ];

    public $orderByOptions = [
        "created_at_asc" => [
            "label" => "A-Z",
            "column" => "created_at",
            "sort" => "asc"
        ],
        "created_at_desc" => [
            "label" => "Z-A",
            "column" => "created_at",
            "order" => "desc"
        ],
        "status_active" => [
            "label" => "In stock",
            "column" => "status" ?? 'Active',
            'order' => "asc"
        ],
        "created_at_latest" => [
            "label" => "Sort_by - Newness",
            "column" => "created_at",
            "order" => "desc",
        ],
    ];
    public function index(Request $request)
    {


        $builder = Product::active();
        $message = $request->message ?? "Result not found, try searching for another keyword";


        if (!empty($key = $request->orderBy)) {
            $optionKeys = array_keys($this->orderByOptions);
            if (in_array($key, $optionKeys)) {
                $option = $this->orderByOptions[$key];
                $builder = $builder->orderBy($option["column"], $option["order"], $option['sort']);
            }
        }

        if (!empty($key = $request->search)) {
            $builder = $builder->where('name', 'LIKE', "%$key%");
        }

        $products = $builder->paginate(25);
        return view("web.pages.shop.index", [
            "products" => $products,
            'message' => $message,
            'orderByOptions' => $this->orderByOptions,
            "metaData" => PageMetaData::shopPage()
        ]);
    }

    public function details($id)
    {

        $in_cart = false;
        $quantity = 1;
        $product = Product::findOrFail($id);
        $related_product = Product::where("category_id", $product->category_id)->whereNotIn("id", [$product->id])->limit(10)->get();

        if (auth()->check()) {
            $user = auth()->user();
            $cart_item = CartItemService::inCart($user->id, $product->id);
            if ($cart_item) {
                $quantity = $cart_item->quantity;
                $in_cart = true;
            }
        }
        return view("web.pages.shop.details", [
            "product" => $product,
            "related_products" => $related_product,
            "in_cart" => $in_cart, "quantity" => $quantity,
            "metaData" => PageMetaData::productDetailsPage($product)
        ]);
    }
}
