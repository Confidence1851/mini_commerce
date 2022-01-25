<?php

namespace Database\Seeders;

use App\Models\CouponCode;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductCategoryTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(PostCategoryTableseeder::class);
        // Post::factory(20)->create();
        $this->call(PermissionTableSeeder::class);
    }
}
