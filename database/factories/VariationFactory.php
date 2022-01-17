<?php

namespace Database\Factories;

use App\Models\Variation;
use Illuminate\Database\Eloquent\Factories\Factory;

class VariationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Variation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->city(),
            'price' => rand(10000,90000).'000',
            'product_id'=>rand(1,29),
            'count' =>rand(0,10),
        ];
    }
}
