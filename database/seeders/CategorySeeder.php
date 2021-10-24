<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Electrical',
            'image' => 'electrical.jpeg']);
        Category::create(['name' => 'Home',
            'image' => 'home.jpg']);
        Category::create(['name' => 'Vehicle',
            'image' => 'vehicle.png']);
        Category::create(['name' => 'Food',
            'image' => 'food.jpg']);
        Category::create(['name' => 'Office',
            'image' => 'office.jpg']);
    }
}
