<?php

namespace App\Models;

use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Vendor extends Model
{
    use HasFactory , SoftDeletes , Loggable;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class , "user_id");
    }

    public function logo()
    {
        return $this->hasOne(File::class, "id", "logo_id");
    }

    public function logoUrl()
    {
        $logo = $this->logo;
        $filepath = optional($logo)->path;
        if (!empty($filepath)) {
            return readFileUrl("encrypt", $filepath);
        }
        else{
            return my_asset("user.png");
        }
    }


    public static function newRefCode()
    {

        // Generate a random code
        $code = strtoupper(getRandomToken(6));

        // Check if the code exists in the user table
        if (self::where("payment_ref", $code)->count() > 0) {

            // If it is in the database , call the function again
            return self::newRefCode();
        }

        // Else return the generated code
        return $code;
    }

    public function scopeApproved($query)
    {
        return $query->where("status" , Constants::APPROVED);
    }


    public function coupons()
    {
        return $this->hasMany(CouponCode::class , "vendor_id" , "user_id");
    }

    public function isApproved()
    {
        return $this->status == Constants::APPROVED;
    }

}
