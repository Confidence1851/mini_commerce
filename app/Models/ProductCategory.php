<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductCategory.
 *
 * @package namespace App\Models;
 */
class ProductCategory extends Model
{
    use HasFactory , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ["id"];

    public function imageUrl()
    {
        if (!empty($path = $this->image)) {
            return readFileUrl("encrypt", $path);
        }
    }

    public function parent(){
        return $this->belongsTo(self::class, "category_id");
    }
}
