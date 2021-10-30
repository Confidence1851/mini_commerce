<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart.
 *
 * @package namespace App\Models;
 */
class Cart extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ["id"];

    public function user(){
        return $this->belongsTo(User::class , "user_id");
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class , 'cart_id');
    }
}
