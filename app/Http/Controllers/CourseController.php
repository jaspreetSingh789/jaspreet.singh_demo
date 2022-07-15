<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Image;
use App\Models\Level;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::assignCourse()
                ->filter(request(['category', 'level', 'search', 'sort_by']))
                ->with('enrollments')
                ->get(),
            'levels' => Level::get(),
            'categories' => Category::get(),
            'statuses' => Status::get()
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
            'certificate' => ['boolean'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'level_id' => ['required', Rule::exists('levels', 'id')],
            'image'  => ['required', 'mimes:jpg,png,jpeg,gif,svg', 'image']
        ]);
        $attributes += [
            'user_id' => Auth::id(),
            'status_id' => Status::DRAFT
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
                ->with('success', __('course created successfully'));
        }
        return redirect()->route('courses.create')
            ->with('success', __('course created successfully'));
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
        $this->authorize('update', $course);

        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
            'certificate' => ['boolean'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'level_id' => ['required', Rule::exists('levels', 'id')],
            'image'  =>  ['required', 'mimes:jpg,png,jpeg,gif,svg', 'image']
        ]);

        $course->update($attributes);

        if (request()->file('image')) {

            $path = $request->file('image')->store('public/images');

            $course->image->image_path = $path;
            $course->image->save();
        }

        return redirect()->route('courses.index')->with('success', __('course updated successfully'));
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        $course->delete();

        return redirect()->route('courses.index')->with('success', __('course deleted successfully'));
    }

    public function status(Request $request, Course $course)
    {
        $course->status_id = $request->status_id;
        $course->save();

        return back()->with('success', __('status updated successfully'));
    }
}
