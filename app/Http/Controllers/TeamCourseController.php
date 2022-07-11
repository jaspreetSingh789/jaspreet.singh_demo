<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Constraint\Count;

// To Assign a Trainer Multiple Courses
class TeamCourseController extends Controller
{
    public function index(User $trainer)
    {
        // unassigned courses
        $unassignedCourses = Course::whereDoesntHave('assignedCourses', function ($query) use ($trainer) {
            $query->where('user_id', $trainer->id);
        })->get();

        return view('users._team-course', [
            'trainer' => $trainer,
            'assignedCourses' =>  $trainer->trainerCourses()->get(),
            'unassignedCourses' => $unassignedCourses
        ]);
    }

    public function store(Request $request, User $trainer)
    {
        $this->authorize('store', $trainer);
        $validator = Validator::make($request->all(), [
            'courseIds' => [
                'required',
                'min:1',
                Rule::exists('courses', 'id')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('Please select valid course'));
        }

        $validated = $validator->validated();

        $courses = Course::findMany($validated['courseIds']);

        $trainer->trainerCourses()->attach($courses);

        return back()->with('success', __('courses assigned successfully'));
    }

    public function destroy(Request $request, User $trainer)
    {
        $this->authorize('delete', $trainer);
        $validator = Validator::make($request->all(), [
            'courseId' => [
                'required',
                'min:1',
                Rule::exists('courses', 'id')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })
            ]
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('Please selecr valid course'));
        }

        $validated = $validator->validated();

        $course = Course::find($validated['courseId']);

        $trainer->trainerCourses()->detach($course);

        return back()->with('success', __('Course unassgned successfully'));
    }
}
