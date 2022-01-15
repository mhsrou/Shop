<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=rand(1,3).'.jpg';
        return [
            'url' => 'products/'.$name,
            'name' => $name,
            'imageable_id' => rand(1, 29),
            'imageable_type' =>  'App\Product',
        ];
    }
}
