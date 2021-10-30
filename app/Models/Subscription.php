<?php

namespace App\Models;

use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Subscription extends Model
{
    use HasFactory , SoftDeletes ,Loggable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class , "user_id");
    }

    public function scopeActive($query)
    {
        return $query->where("is_active" , Constants::ACTIVE);
    }

    public function scopeRunning($query)
    {
        return $query->where("expires_at", ">", now());
    }
}


