<?php

namespace App\Models;

use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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

    public function activeImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->where("status", Constants::ACTIVE);
    }

    public function getDefaultImage()
    {
        $image = $this->activeImages()->where("isDefault", Constants::ACTIVE)->first();
        if (empty($image)) {
            $image = $this->activeImages()->first();
        }
        if (empty($image)) {
            return "";
        }
        return $image->getImage(false);
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
}


