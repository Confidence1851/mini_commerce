<?php

namespace Database\Factories;

use App\Helpers\Constants;
use App\Helpers\MediaHandler;
use App\Models\File;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $mediaHandler = new MediaHandler(new File());
        $filePath = public_path("tmp/cat_tech.jpg");
        $mediaHandler->setMoveFile(false);
        $cover_image = $mediaHandler->saveFromFilePath($filePath, "post_category", null, null);

        return [
            "uuid" => Post::getUuid(),
            "title" =>   $this->faker->sentence ,
            "body" => $this->faker->text($maxNbChars = 1000),
            "type" => "Blog",
            "category_id"  => PostCategory::where("is_active" , Constants::ACTIVE)->inRandomOrder()->first()->id,
            "cover_image" => $cover_image->id,
            "meta_title" => $this->faker->sentence,
            "meta_description" => $this->faker->text($maxNbChars = 100),
            "meta_keywords" => implode("," , explode(" ", $this->faker->sentence)),
            "is_published" => Constants::ACTIVE,
            "is_featured"  => [Constants::ACTIVE , Constants::INACTIVE ,  Constants::INACTIVE][rand(0 , 1)],
            "is_top_story"  => Constants::INACTIVE,
            "can_comment" => Constants::ACTIVE,
            "is_sponsored" =>[Constants::ACTIVE , Constants::INACTIVE,  Constants::INACTIVE][rand(0 , 2)],
        ];
    }
}
