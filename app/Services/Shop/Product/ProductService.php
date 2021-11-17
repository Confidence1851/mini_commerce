<?php

namespace App\Services\Shop\Product;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductService
{
    public static function getById($id): Product
    {
        return Product::find($id);
    }


    public static function getByReference($reference): Product
    {
        return Product::where("reference" , $reference)->first();
    }

    public static function generateReference(){
        $code = strtoupper(getRandomToken(6));
        if(Product::where("reference" , $code)->count() > 0){
            return self::generateReference();
        }
        return $code;
    }

}
