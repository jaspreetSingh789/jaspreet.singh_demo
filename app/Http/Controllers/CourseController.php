<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Image;
use App\Models\Level;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::assignCourse()->filter(request(['category', 'level', 'search', 'sort_by']))
                ->get(),
            'levels' => Level::all(),
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('courses.create');
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

        if ($request->input('action') === 'save') {
            return redirect()->route('courses.edit', $course)
                ->with('success', __('Course created successfully'));
        }
        return redirect()->route('courses.create')
            ->with('success', __('Course created successfully'));
    }

    public function edit(Course $course)
    {
        $this->authorize('edit', $course);
        return view('courses.edit', [
            'course'  => $course
        ]);
    }

    public function update(Request $request, Course $course)
    {
        // $this->authorize('update', $course);

        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
            'certificate' => '',
            'category_id' => ['required', 'exists:App\Models\Category,id'],
            'level_id' => ['required', 'exists:App\Models\Level,id'],
        ]);

        $course->update($attributes);

        return redirect()->route('courses.index')->with('success', __('course updated successfully'));
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        $course->delete();

        return redirect()->route('courses.index')->with('success', __('course deleted successfully'));
    }
}
