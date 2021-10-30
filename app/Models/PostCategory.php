<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function coverImage()
    {
        return $this->hasOne(File::class, "id", "cover_image");
    }

    public function coverImageUrl()
    {
        $coverImage = $this->coverImage;

        $filepath = optional($coverImage)->path;

        if (!empty($filepath)) {
            return readFileUrl("encrypt", $filepath);
        }
    }

    public function posts()
    {
        return $this->hasMany(Post::class , "category_id" , "id");
    }

}
