<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use App\Models\DeliveryAddress as Daddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

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
        if(Daddress::count() == 0){
            $Dadd = Daddress::factory()->create();
        }
        else{

            $Dadd = Daddress::inRandomOrder()->first();
        }
        if(Order::count() == 0){
            $order = Order::factory()->create();
        }
        else{
            $order = Order::inRandomOrder()->first();
        }

        return [
            'user_id' => $user->id,
            'coupon_id' => rand(100 , 10000),
            'payment_id' => rand(1 , 10),
            'delivery_address_id' => $Dadd->id,
            'reference' ->$this->faker->name,
            'amount' => rand(100 , 10000),
            'discount' => rand(1 , 10),

        ];
    }
}
