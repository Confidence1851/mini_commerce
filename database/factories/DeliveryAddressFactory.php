<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use App\Models\DeliveryAddress as Daddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Daddress::class;

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
        return [
            'name' =>$this->faker->name,
            'apartment_no' => rand(1 , 20),
            'address' => $this->faker->text,
            'town' =>  $this->faker->text,
            'city' =>  $this->faker->text,
            'state' => $this->faker->text,  
            'country' =>  $this->faker->text,
            'phone' => rand(10000000 , 100000000000),
        ];
    }
}
