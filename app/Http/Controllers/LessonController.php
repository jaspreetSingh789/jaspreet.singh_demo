<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();

        return back()->with('success', 'test deleted successfully');
    }
}
