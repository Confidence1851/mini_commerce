<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponCode extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class , "used_by");
    }

    public function vendor()
    {
        return $this->belongsTo(User::class , "vendor_id");
    }

    public static function getCode(){

        // Generate a random code
        $code = strtoupper(getRandomToken(10));

        // Check if the code exists in the user table
        if(self::where("code" , $code)->count() > 0){

            // If it is in the database , call the function again
            return self::getCode();
        }

        // Else return the generated code
        return $code;
    }

}
