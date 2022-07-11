<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserEnrollmentController extends Controller
{
    public function index(User $user)
    {
        // unenrolled courses
        $unenrolledCourses = Course::whereDoesntHave('enrolledCourses', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('users._user-enroll', [
            'user' => $user,
            'unenrolledCourses' => $unenrolledCourses,
            'enrolledCourses' => $user->courses()->get()
        ]);
    }

    public function store(Request $request, User $user)
    {
        $this->authorize('store', $user);
        $validator = Validator::make($request->all(), [
            'courseIds' => [
                'required',
                'min:1',
                Rule::exists('courses', 'id')
            ]
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('Please select a valid course'));
        }
        $validated = $validator->validated();

        $courses = Course::findMany($validated['courseIds']);

        $user->courses()->attach($courses);

        return back()->with('success', __('courses added successfully'));
    }

    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);
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
            return back()->with('error', __('Please select a valid course'));
        }

        $validated = $validator->validated();

        $course = Course::find($validated['courseId']);

        $user->courses()->detach($course);

        return back()->with('success', __('Course unenrolled successfully'));
    }
}
