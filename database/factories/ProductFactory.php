<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if(User::count() == 0){
            $user = User::factory()->create();
        }
        else{
            $user = User::inRandomOrder()->first();
        }
        if(ProductCategory::count() == 0){
            $cat = ProductCategory::factory()->create();
        }
        else{
            $cat = ProductCategory::inRandomOrder()->first();
        }
        return [
            'category_id' => $cat->id,
            'name' => $this->faker->name,
            'description' => $this->faker->text(),
            'status' => "Active",
            'price' => rand(100 , 10000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
