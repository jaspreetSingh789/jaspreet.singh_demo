<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function create(Course $course)
    {
        return view('units.create', [
            'course' => $course
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $attributes =  $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255']
        ]);

        $unit = Unit::create($attributes);

        $course->units()->attach($unit->id);

        switch ($request->action) {
            case 'create':
                return redirect()->route('courses.show', $course)
                    ->with('success', __('unit created successfully.'));
                break;
            case 'create_another':
                return back()->with('success', __('unit created successfully.'));
                break;
        }
    }

    public function edit(Course $course, Unit $unit)
    {
        return view('units.edit', [
            'unit' => $unit,
            'course' => $course,
            'lessons' => $unit->lessons()->get()
        ]);
    }

    public function update(Request $request, Unit $unit, Course $course)
    {
        $attributes =  $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255']
        ]);

        $unit->update($attributes);

        return back()->with('success', __('unit updated successfully.'));
    }

    public function destroy(Unit $unit, Course $course)
    {
        $unit->delete();

        return back()->with('success', __('unit deleted successfully.'));
    }
}
