<?php
namespace App\QueryBuilder;

use App\Constants\ProductConstants;
use App\Models\Product;

class ShopQueryBuilder {

    static function filterIndex(array $data)
    {
        $builder = Product::active()->whereHas("defaultImage")->with("defaultImage");
        $orderByOptions = ProductConstants::SHOP_ORDER_OPTIONS;

        if (!empty($key = $data["orderBy"] ?? null)) {
            $optionKeys = array_keys($orderByOptions);
            if (in_array($key, $optionKeys)) {
                $option = $orderByOptions[$key];
                $builder = $builder->orderBy($option["column"], $option["order"]);
            }
        }
        else{
            $builder = $builder->latest();

        }

        if (!empty($key = $data["search"] ?? null )) {
            $builder = $builder->where('name', 'LIKE', "%$key%");
        }

        if (!empty($key = $data["category_id"] ?? null )) {
            $builder = $builder->where('category_id', 'LIKE', "%$key%");
        }

        

        return $builder;
    }
}
