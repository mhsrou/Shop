<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Product::factory()
//            ->count(29)
//            ->create();

        for($i = 0; $i < 30;$i++){
            Image::factory()->count(3)->for(
                Product::factory(), 'imageable'
            )->create();
        }
    }
}
