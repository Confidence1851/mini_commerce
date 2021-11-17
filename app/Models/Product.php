<?php

namespace App\Models;

use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
}


