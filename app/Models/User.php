<?php

namespace App\Models;

use App\Helpers\Constants;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes , HasRoles , Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'role',
        'phone',
        'email',
        'password',
        'ref_code',
        'avatar_id',
        'activity_provider_key'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function newRefCode()
    {

        // Generate a random code
        $code = strtoupper(getRandomToken(6));

        // Check if the code exists in the user table
        if (self::where("ref_code", $code)->count() > 0) {

            // If it is in the database , call the function again
            return self::newRefCode();
        }

        // Else return the generated code
        return $code;
    }


    public function wallet()
    {
        return $this->hasOne(Wallet::class, "user_id");
    }

    public function plan()
    {
        return $this->hasOne(Subscription::class, "user_id")
        // ->where("expires_at", ">", now())
        ->where("is_active" , Constants::ACTIVE)
        ->orderby("expires_at" , "desc");
    }

    public function activeSubscriptions()
    {
        return $this->hasMany(Subscription::class, "user_id")
        ->where("is_active" , Constants::ACTIVE)
        ->orderby("expires_at" , "desc");
    }


    public function names()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function activePlan()
    {
        $plan = $this->plan;
        if (empty($plan)) {
            $plan = new Subscription([
                "plan_name" => "Free",
                "price" => 0,
            ]);
        }
        return $plan;
    }

    public function coupon()
    {

        return $this->hasMany(CouponCode::class);
    }


    public function refUrl()
    {
        return route("ref_invite", $this->ref_code);
    }

    public function referralRecord()
    {
        return $this->hasOne(Referral::class, "user_id", "id")->with("referrer");
    }

    public function referrer()
    {
        return optional(optional($this->referralRecord)->referrer);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class , "referrer_id" , "id")
        ->whereHas("user")
        ->with("user")
        ->orderby("created_at", "desc");
    }


    public function transactions(){
        return $this->hasMany(Transaction::class , "user_id")
        ->whereHas("user")
        ->with("user")
        ->orderby("created_at", "desc");
    }

    public function avatar()
    {
        return $this->hasOne(File::class, "id", "avatar_id");
    }

    public function avatarUrl()
    {
        $avatar = $this->avatar;

        $filepath = optional($avatar)->path;

        if (!empty($filepath)) {
            return readFileUrl("encrypt", $filepath);
        }

        return my_asset("user.png");
    }
    //  public function referralRecord()
    //  {
    //      return $this->all();
    //  }

    public function vendor()
    {
        return $this->hasOne(Vendor::class , "user_id" , "id");
    }

    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class , "user_id");
    }

    public function isAdmin()
    {
        return $this->role == Constants::ADMIN_USER;
    }

    public function hasJoinedProvider()
    {
        return !empty($this->activity_provider_key);
    }

}
