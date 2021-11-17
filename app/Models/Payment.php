<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory , SoftDeletes , Loggable;

    protected $guarded = [];

    public function getStatus(){
        return $this->getModelStatus($this->status);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function admin(){
        return $this->belongsTo(User::class , "admin_id");
    }
}
