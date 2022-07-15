<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'title' => 'course 1',
            'slug' => 'course-1',
            'description' => 'description',
            'user_id' => 1,
            'category_id' => 1,
            'level_id' => 1,
            'status_id' => 1,
            'certificate' => 0,
        ]);

        Course::create([
            'title' => 'course 2',
            'slug' => 'course-2',
            'description' => 'description',
            'user_id' => 1,
            'category_id' => 1,
            'level_id' => 1,
            'status_id' => 1,
            'certificate' => 0,
        ]);

        Course::create([
            'title' => 'course 3',
            'slug' => 'course-3',
            'description' => 'description',
            'user_id' => 1,
            'category_id' => 1,
            'level_id' => 1,
            'status_id' => 1,
            'certificate' => 0,
        ]);

        Course::create([
            'title' => 'course 4',
            'slug' => 'course-4',
            'description' => 'description',
            'user_id' => 1,
            'category_id' => 1,
            'level_id' => 1,
            'status_id' => 1,
            'certificate' => 0,
        ]);
    }
}
