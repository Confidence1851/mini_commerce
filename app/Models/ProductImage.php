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
    protected $guarded = ["id"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function url()
    {
        if (!empty($path = $this->image)) {
            return readFileUrl("encrypt", $path);
        }
    }

    // public function
}
