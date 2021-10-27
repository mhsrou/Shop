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
        Category::create([
            'name' => 'Electrical',
            'image' => 'electrical.jpeg'
        ]);
        Category::create([
            'name' => 'Home',
            'image' => 'home.jpg'
        ]);
        Category::create([
            'name' => 'Vehicle',
            'image' => 'vehicle.png'
        ]);
        Category::create([
            'name' => 'Food',
            'image' => 'food.jpg'
        ]);
        Category::create([
            'name' => 'Office',
            'image' => 'office.jpg'
        ]);
        Category::create([
            'name' => 'Mobile',
            'image' => 'electrical.jpeg',
            'parent_id' => 1
        ]);
        Category::create([
            'name' => 'Laptop',
            'image' => 'food.jpg',
            'parent_id' => 1
        ]);
        Category::create([
            'name' => 'Console',
            'image' => 'electrical.jpeg',
            'parent_id' => 1
        ]);
        Category::create([
            'name' => 'Refrigrator',
            'image' => 'home.jpg',
            'parent_id' => 2
        ]);
        Category::create([
            'name' => 'Dishwasher',
            'image' => 'electrical.jpeg',
            'parent_id' => 2
        ]);
        Category::create([
            'name' => 'Couches',
            'image' => 'office.jpg',
            'parent_id' => 2
        ]);
        Category::create([
            'name' => 'Refrigrator',
            'image' => 'home.jpg',
            'parent_id' => 3
        ]);
        Category::create([
            'name' => 'Dishwasher',
            'image' => 'electrical.jpeg',
            'parent_id' => 3
        ]);
        Category::create([
            'name' => 'Couches',
            'image' => 'office.jpg',
            'parent_id' => 3
        ]);
        Category::create([
            'name' => 'Refrigrator',
            'image' => 'home.jpg',
            'parent_id' => 4
        ]);
        Category::create([
            'name' => 'Dishwasher',
            'image' => 'electrical.jpeg',
            'parent_id' => 4
        ]);
        Category::create([
            'name' => 'Couches',
            'image' => 'office.jpg',
            'parent_id' => 4
        ]);
        Category::create([
            'name' => 'Refrigrator',
            'image' => 'home.jpg',
            'parent_id' => 5
        ]);
        Category::create([
            'name' => 'Dishwasher',
            'image' => 'electrical.jpeg',
            'parent_id' => 5
        ]);
        Category::create([
            'name' => 'Couches',
            'image' => 'office.jpg',
            'parent_id' => 5
        ]);

    }
}
