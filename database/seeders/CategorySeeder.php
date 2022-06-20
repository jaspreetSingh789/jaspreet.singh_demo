<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'user_id' => 1,
            'name' => 'category 1',
            'slug' => 'category-1'
        ]);

        Category::create([
            'user_id' => 1,
            'name' => 'category 2',
            'slug' => 'category-2'
        ]);

        Category::create([
            'name' => 'category 3',
            'slug' => 'category-3'
        ]);

        Category::create([
            'name' => 'category 4',
            'slug' => 'category-4'
        ]);
    }
}