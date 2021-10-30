<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory , SoftDeletes , Loggable;

    protected $guarded = ["id"];

    public function price()
    {
       return format_money($this->price);
    }

    public function getFeatures()
    {
       return json_decode($this->features , true);
    }

    public function scopeActive($query)
    {
        return $query->where("is_active" , 1);
    }
}
