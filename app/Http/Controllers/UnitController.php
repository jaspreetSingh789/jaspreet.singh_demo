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
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:5']
        ]);

        $unit = Unit::create($attributes);

        $course->units()->attach($unit->id);

        if ($request->input('action') == 'save') {
            return redirect()->route('courses.units.edit', [$course, $unit])
                ->with('success', __('unit created successfully.'));
        }
        return back()->with('success', __('unit created successfully.'));
    }

    public function edit(Course $course, Unit $unit)
    {
        $this->authorize('edit', $course);

        return view('units.edit', [
            'unit' => $unit,
            'course' => $course,
            'lessons' => $unit->lessons()->get()
        ]);
    }

    public function update(Request $request, Course $course, Unit $unit)
    {
        $this->authorize('update', $course);

        $attributes =  $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:5']
        ]);

        $unit->update($attributes);

        return back()->with('success', __('unit updated successfully.'));
    }

    public function destroy(Course $course, Unit $unit)
    {
        $this->authorize('delete', $course);

        $unit->delete();

        return back()->with('success', __('unit deleted successfully.'));
    }
}
