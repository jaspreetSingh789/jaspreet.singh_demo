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

        return back()->with('success', 'unit created successfully.');
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', [
            'unit' => $unit
        ]);
    }

    public function update(Request $request, Unit $unit)
    {
        $attributes =  $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255']
        ]);

        $unit->update($attributes);

        return back()->with('success', 'unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return back()->with('success', 'unit deleted successfully.');
    }
}
