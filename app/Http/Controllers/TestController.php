<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
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

    public function store(TestRequest $request, Course $course, Unit $unit)
    {
        $attributes = $request->validated();

        $test = Test::create($attributes);
        $lesson = Lesson::make([
            'name' => $test->name,
            'unit_id' => $unit->id,
            'duration' => $test->duration
        ]);

        $unit->update([
            'duration' => $unit->duration + $lesson->duration,
        ]);

        $lesson->lessonable()->associate($test);

        $lesson->save();

        if ($request->input('action') === 'save') {
            return redirect()->route('courses.tests.edit', [$course, $test])
                ->with('success', 'test created successfully');
        }

        return back()->with('success', __('test created successfully'));
    }

    public function edit(Course $course, Test $test)
    {
        $this->authorize('edit', $course);

        return view('tests.edit', [
            'course' => $course,
            'lesson' => $test->lesson->load('unit'),
            'test' => $test,
            'questions' => $test->questions()->get()
        ]);
    }

    public function update(Request $request, Course $course, Unit $unit, Lesson $lesson, Test $test)
    {
        $this->authorize('update', $course);

        $attributes = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'pass_percentage' => ['required', 'min:0', 'max:100', 'numeric'],
            'duration' => ['required', 'numeric', 'min:0']
        ]);

        $test->update($attributes);

        $test->lesson->name = $test->name;
        $test->lesson->duration = $test->duration;
        $test->lesson->save();

        return back()->with('success', __('test updated successfully'));
    }
}
