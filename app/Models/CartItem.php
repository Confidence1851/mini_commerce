<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CartItem.
 *
 * @package namespace App\Models;
 */
class CartItem extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function cart(){
        return $this->belongsTo(Cart::class , "cart_id");
    }

    public function product(){
        return $this->belongsTo(Product::class , "product_id");
    }

    public function getPrice(){
        return $this->product->getPrice();
    }

    public function getSubtotal(){
        return $this->total;
    }

}
