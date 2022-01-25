<?php

namespace App\Models;

use App\Constants\StatusConstants;
use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = ["id"];

    public function vendor()
    {
        return $this->belongsTo(User::class, "vendor_id");
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, "category_id");
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }


    public function defaultImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id')->latest()->where("is_default", Constants::ACTIVE);
    }

    public function getDefaultImage()
    {
        $image = $this->defaultImage;
        if (empty($image)) {
            $image = $this->images()->first();
        }
        if (empty($image)) {
            return "";
        }
        return $image->url();
    }

    public function getPrice()
    {
        return format_money($this->price - $this->discount);
    }

    public function getRealPrice()
    {
        return format_money($this->price);
    }

    public function detailUrl()
    {
        return route("web.shop.details" , ["id" => $this->id, "slug" => slugify($this->name)]);
    }

    public function discountPercent()
    {
        if($this->discount == 0){
            return 0;
        }
        return number_format($this->discount * 100 / $this->price);
    }

    public function scopeSearch($query , $value){
        $query->whereRaw("CONCAT(name,' ', reference) LIKE ?", ["%$value%"])
        ->orWhere("name" , "like" , "%$value%");
    }

    public function scopeActive($query){
        $query->where("status" , StatusConstants::ACTIVE )
        ->orwhere("status", StatusConstants::INACTIVE);
    }

    public function scopeOrder( $orderByOptions){
        Product::where('created_at', 'asc', $orderByOptions)->latest();
    }

    public function scopeInactive($query){
        $query->where("status" , StatusConstants::INACTIVE);
    }
}



