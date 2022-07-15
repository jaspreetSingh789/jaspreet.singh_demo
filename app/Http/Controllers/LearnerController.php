<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearnerController extends Controller
{
    public function index()
    {
        // Course::assignCourse()->get(),
        // $course = Auth::user()->enrollments()->with('units')->get();
        // dd($course->first()->pivot->completed_percentage);

        return view('learner.courses.index', [
            'courses' => Auth::user()->enrollments()->published()->with('units')->get()
        ]);
    }

    public function show(Course $course)
    {
        return view('learner.courses.show', [
            'course' => $course,
            'units' => $course->units
        ]);
    }
}
