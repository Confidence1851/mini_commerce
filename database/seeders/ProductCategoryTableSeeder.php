<?php

namespace Database\Seeders;

use App\Helpers\Constants;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["Men" , "Women" , "Gears" , "Sweat Pants"];
        foreach($categories as $category){
            ProductCategory::firstOrCreate(
                ['name' => $category],
                [
                'name' => $category,
                "status" => "Active",
                "image" => "/"
                ]
            );
        }
    }
}
