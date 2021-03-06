<?php

namespace Database\Factories;

use App\Models\Product;
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
        return [
            'name' => $this->faker->company(),
            'desc' => $this->faker->city(),
//            'price' => rand(10000,90000).'000',
            'discount' => rand(0,7)*10,
            'is_incredible' => rand(0,1)<0.5,
            'category_id'=>rand(1,11),
            'user_id' =>rand(1,10),
            'status' => $this->faker->randomElement(['draft', 'available', 'soon', 'running_out']),
        ];
    }
}
