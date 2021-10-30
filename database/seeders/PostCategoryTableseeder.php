<?php

namespace Database\Seeders;

use App\Helpers\MediaHandler;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategoryTableseeder extends Seeder
{

    public $mediaHandler;
    public function __construct(MediaHandler $mediaHandler)
    {
        $this->mediaHandler = $mediaHandler;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = public_path("tmp/cat_tech.jpg");
        $this->mediaHandler->setMoveFile(false);
        $cover = $this->mediaHandler->saveFromFilePath($filePath, "post_category", null, null);
        $data = [
            [
                "name" => "Technology",
                "cover_image" => $cover->id,
                "is_active" => 1,
                "is_trending" => 0,
            ],
            [
                "name" => "Leadership",
                "cover_image" => $cover->id,
                "is_active" => 1,
                "is_trending" => 0,
            ],
            [
                "name" => "Technology",
                "cover_image" => $cover->id,
                "is_active" => 1,
                "is_trending" => 0,
            ],
            [
                "name" => "Health",
                "cover_image" => $cover->id,
                "is_active" => 1,
                "is_trending" => 1,
            ],
            [
                "name" => "Travel",
                "cover_image" => $cover->id,
                "is_active" => 1,
                "is_trending" => 1,
            ],
            [
                "name" => "Sports",
                "cover_image" => $cover->id,
                "is_active" => 1,
                "is_trending" => 1,
            ],
            [
                "name" => "Animals",
                "cover_image" => $cover->id,
                "is_active" => 1,
                "is_trending" => 1,
            ],
        ];

        foreach ($data as $category) {
            PostCategory::updateOrCreate([
                "name" => $category["name"]
            ], $category);
        }
    }
}
