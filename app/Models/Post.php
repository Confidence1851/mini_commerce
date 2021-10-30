<?php

namespace App\Models;

use App\Helpers\Constants;
use App\Helpers\PostHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function setBodyAttribute($value)
    {
        $postHandler = new PostHandler;
        $filename = $this->getRawOriginal("body");
        $this->attributes['body'] = $postHandler->setBodyAttribute($filename, $this->uuid, $value);
    }

    public function getBodyAttribute($value)
    {
        $postHandler = new PostHandler;
        return $this->attributes['body'] =  $postHandler->getBodyAttribute($value);
    }

    public static function getUuid()
    {

        // Generate a random code
        $code = strtoupper(getRandomToken(6));

        // Check if the code exists in the table
        if (self::where("uuid", $code)->count() > 0) {

            // If it is in the database , call the function again
            return self::getUuid();
        }

        // Else return the generated code
        return $code;
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, "category_id", "id");
    }

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


    public function coverVideo()
    {
        return $this->hasOne(File::class, "id", "cover_video");
    }

    public function coverVideoUrl()
    {
        $coverVideo = $this->coverVideo;

        $filepath = optional($coverVideo)->path;

        if (!empty($filepath)) {
            return readFileUrl("encrypt", $filepath);
        }
    }

    public function detailsUrl($withSharer = false)
    {
        $sharer = null;
        if ($withSharer && $user =  auth()->user()) {
            $sharer = $user->ref_code;
        }

        return route("blog.details", [
            "uuid" => $this->uuid,
            "slug" => slugify($this->title),
            "sharer" => $sharer
        ]);
    }

    public function categoryUrl()
    {
        return "#";
    }

    public function dateFormat($format = null)
    {
        $date = date("F d, Y", strtotime($this->created_at));
        if (!empty($format)) {
            if ($format == "short") {
                $format = "M d, Y";
            }
            $date = date($format, strtotime($this->created_at));
        }

        return $date;
    }

    public function author()
    {
        return $this->belongsTo(User::class, "author_id", "id");
    }

    public function authorName()
    {
        return optional($this->author)->name ?? "Admin";
    }

    public function authorImage()
    {
        $image = optional($this->author)->avatarUrl();

        if (empty($image)) {
            $image = my_asset("user.png");
        }
        return $image;
    }

    public function scopeFindByUuid($query, $uuid)
    {
        return $query->where("uuid", $uuid);
    }

    public function scopeActive($query)
    {
        return $query->where("is_published", Constants::ACTIVE);
    }

    public function scopeBlog($query)
    {
        return $query->active()->where("type", Constants::BLOG);
    }

    public function scopeVlog($query)
    {
        return $query->active()->where("type", Constants::VLOG);
    }

    public function scopeTopStories($query)
    {
        return $query->where("is_top_story", Constants::ACTIVE);
    }

    public function scopeFeatured($query)
    {
        return $query->where("is_featured", Constants::ACTIVE);
    }

    public function scopeSponsored($query, $option = null)
    {
        return $query->where("is_sponsored", $option ?? Constants::ACTIVE);
    }

    public function scopeSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query = $query->where("title", "like", "%$keyword%");
        }
        return $query;
    }

    public function scopeRelatedCategory($query, $category_id)
    {
        return $query->where("category_id", $category_id);
    }

    public function estReadTime()
    {
        return rand(1, 30);
    }

    public function views()
    {
        return rand(1, 30) . "K";
    }

    public function isBlog()
    {
        return strtolower($this->type) == strtolower(Constants::BLOG);
    }

    public function categoryName()
    {
        return optional($this->category)->name;
    }

    public function isSponsored()
    {
        return $this->is_sponsored == Constants::ACTIVE;
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class, "post_id", "id");
    }

    public function sharePlatforms()
    {
        // $platforms = [];
        // if ($this->isSponsored()) {
        //     $currentHour = now()->format("H");
        //     if (in_array($currentHour, range(0, 10))) {
        //         $platforms[] = "facebook";
        //     }
        //     if (in_array($currentHour, range(11, 15))) {
        //         $platforms[] = "telegram";
        //     }
        //     if (in_array($currentHour, range(16, 23))) {
        //         $platforms[] = "whatsapp";
        //     }
        // } else {
        $platforms = ["facebook", "telegram", "whatsapp"];
        // }
        return $platforms;
    }
}
