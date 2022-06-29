<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use App\Notifications\UserEnrollNotification;
use App\Notifications\UserUnenrollNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EnrollUserController extends Controller
{
    public function index(Course $course)
    {
        // enrolled users
        $enrolledUsers = $course->enrolledUsers()->get();

        // unenrolled users
        $unenrolledUsers = User::whereDoesnthave('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->employee()->active()->get();

        return view('courses.enroll-user', [
            'course' => $course,
            'enrolledUsers' => $enrolledUsers,
            'unenrolledUsers' => $unenrolledUsers
        ]);
    }

    public function store(Request $request, Course $course)
    {
        // $this->authorize('edit', $course);
        $validator = Validator::make($request->all(), [
            'unenrolledUsers' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::EMPLOYEE);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'please select at least one user!');
        }

        $validated = $validator->validated();
        $selectedUsers  = User::VisibleTo()->findMany($validated['unenrolledUsers']);

        $course->enrolledUsers()->attach($selectedUsers, [
            'assigned_by' => Auth::id(),
            'status' => Status::DRAFT
        ]);

        Notification::send($selectedUsers, new UserEnrollNotification(Auth::user(), $course));
        return back()->with('success', 'users enrolled successfully.');
    }

    public function destroy(Request $request, Course $course)
    {
        // $this->authorize('delete', $course);
        $validator = Validator::make($request->all(), [
            'enrolledUserId' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::EMPLOYEE);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'please select at least one user!');
        }

        $validated = $validator->validated();

        $user = User::VisibleTo()->find($validated['enrolledUserId']);

        $course->enrolledUsers()->detach($validated['enrolledUserId']);

        Notification::send($user, new UserUnenrollNotification(Auth::user(), $course));
        return back()->with('success', 'user unenrolled successfully.');
    }
}
