<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::all(),
        ]);
    }

    public function create()
    {
        return view('courses.create', [
            'categories' => Category::all(),
            'levels' => Level::all(),
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|min:3|max:50',
            'description' => 'required|min:5',
            'certificate' => '',
            'category_id' => 'required',
            'level_id' => 'required',
        ]);
        $attributes += [
            'user_id' => Auth::id(),
        ];

        Course::create($attributes);

        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }

    public function edit(Course $course)
    {

        return view('courses.edit', [
            'course'  => $course,
            'categories' => Category::all(),
            'levels' => Level::all(),
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $attributes = $request->validate([
            'title' => 'required|min:3|max:50',
            'description' => 'required|min:5',
            'certificate' => '',
            'category_id' => 'required',
            'level_id' => 'required',
        ]);

        $course->update($attributes);

        return redirect()->route('courses.index')->with('success', 'course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
    }
}
