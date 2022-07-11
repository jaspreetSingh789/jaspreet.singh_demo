<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use App\Notifications\CourseAssignedNotification;
use App\Notifications\CourseUnassignedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseTeamController extends Controller
{
    public function index(Course $course)
    {
        //unassigned trainers
        $unassignedTrainers = User::whereDoesnthave('trainerCourses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->trainer()->active()->get();

        return view('courses.course-assign', [
            'assignedTrainers' =>   $course->assignedTrainers()->get(),
            'unassignedTrainers' => $unassignedTrainers,
            'course' => $course
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $this->authorize('store', $course);
        $validator = Validator::make($request->all(), [
            'userIds' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('please select at least one user!'));
        }

        $validated = $validator->validated();
        $selectedUsers  = User::VisibleTo()->findMany($validated['userIds']);

        $course->assignedTrainers()->attach($selectedUsers);

        Notification::send($selectedUsers, new CourseAssignedNotification(Auth::user(), $course));
        return back()->with('success', __('course assigned successfully.'));
    }

    public function destroy(Request $request, Course $course)
    {
        $this->authorize('delete', $course);
        $validator = Validator::make($request->all(), [
            'userId' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('please select at least one user!'));
        }

        $validated = $validator->validated();

        $user = User::VisibleTo()->find($validated['userId']);

        $course->assignedTrainers()->detach($validated['userId']);

        Notification::send($user, new CourseUnassignedNotification(Auth::user(), $course));
        return back()->with('success', __('trainer unassigned successfully.'));
    }
}
