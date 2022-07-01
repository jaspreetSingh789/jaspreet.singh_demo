<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Image;
use App\Models\Level;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class CourseController extends Controller
{
    public function index()
    {
        if (request(['category', 'level', 'search', 'sort_by'])) {
            return view('courses.index', [
                'courses' => Course::filter(request(['category', 'level', 'search', 'sort_by']))->get(),
                'levels' => Level::all(),
                'categories' => Category::all()
            ]);
        } else {
            return view('courses.index', [
                'courses' => Course::orderBy('created_at', 'DESC')->get(),
                'levels' => Level::all(),
                'categories' => Category::all()
            ]);
        }
    }

    public function create()
    {
        return view('courses.create', [
            'categories' => Category::all(),
            'levels' => Level::all(),
        ]);
    }

    public function show(Course $course)
    {
        return view('courses.show', [
            'course' => $course,
            'units' => $course->units
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
            'certificate' => '',
            'category_id' => ['required', 'exists:App\Models\Category,id'],
            'level_id' => ['required', 'exists:App\Models\Level,id'],
            'image'  => ['required', 'mimes:jpg,png,jpeg,gif,svg']
        ]);
        $attributes += [
            'user_id' => Auth::id(),
        ];

        $course =  Course::create($attributes);

        if (request()->file('image')) {

            $path = $request->file('image')->store('public/images');

            Image::create([
                'image_path' => $path,
                'course_id' => $course->id
            ]);
        }

        return redirect()->route('courses.create')->with('success', 'Course created successfully');
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
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
            'certificate' => '',
            'category_id' => ['required', 'exists:App\Models\Category,id'],
            'level_id' => ['required', 'exists:App\Models\Level,id'],
        ]);

        $course->update($attributes);

        return redirect()->route('courses.index')->with('success', 'course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'course deleted successfully');
    }
}
