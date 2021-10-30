<?php

namespace App\Models;

use App\Traits\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImage.
 *
 * @package namespace App\Models;
 */
class ProductImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public $productImagePath = "";
    public function getImage($getPath = true)
    { //if true , return only path else return image url
        $relativePath = "$this->productImagePath/$this->image";
        if ($getPath) {
            return $relativePath;
        }
        return readFileUrl("encrypt", $relativePath);
    }
}
