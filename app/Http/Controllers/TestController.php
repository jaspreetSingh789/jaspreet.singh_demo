<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create(Course $course, Unit $unit)
    {
        return view('tests.create', [
            'unit' => $unit,
            'course' => $course
        ]);
    }

    public function store(Request $request, Course $course, Unit $unit)
    {
        $attributes = $request->validate([
            'name' => 'required', 'min:3', 'max:255',
            'pass_percentage' => 'required', 'min:0', 'max:100',
            'duration' => 'required', 'numeric', 'min:0'
        ]);

        $test = Test::create($attributes);
        $lesson = Lesson::make([
            'name' => $test->name,
            'unit_id' => $unit->id
        ]);

        $lesson->lessonable()->associate($test);

        $lesson->save();

        if ($request->input('action') === 'save') {
            return redirect()->route('courses.units.tests.edit', [$course, $unit, $test])->with('success', 'test created successfully');
        }

        return back()->with('success', __('test created successfully'));
    }

    public function edit(Course $course, Test $test)
    {
        return view('tests.edit', [
            'course' => $course,
            'lesson' => $test->lesson->load('unit'),
            'test' => $test,
            'questions' => $test->questions()->get()
        ]);

        // {{ route('courses.tests.questions.create',[$course,$unit,$test]) 
    }

    public function update(Request $request, Course $course, Unit $unit, Lesson $lesson, Test $test)
    {
        $attributes = $request->validate([
            'name' => 'required', 'min:1', 'max:30',
            'pass_percentage' => 'required', 'min:0', 'max:100', 'numeric',
            'duration' => 'required', 'numeric', 'min:0'
        ]);

        $test->update($attributes);

        $test->lesson->name = $test->name;
        $test->lesson->save();

        return back()->with('success', __('test updated successfully'));
    }
}
