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

class EnrollmentController extends Controller
{
    public function index(Course $course)
    {
        // unenrolled users
        $unenrolledUsers = User::whereDoesnthave('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->enrolledUsers()->active()->get();

        return view('courses.enroll-user', [
            'course' => $course,
            'enrolledUsers' => $course->enrolledUsers()->get(),
            'unenrolledUsers' => $unenrolledUsers,
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
                    return $query->where('role_id', Role::EMPLOYEE)->orWhere('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('please select at least one user!'));
        }

        $validated = $validator->validated();
        $selectedUsers  = User::VisibleTo()->findMany($validated['userIds']);

        $course->enrolledUsers()->attach($selectedUsers, [
            'assigned_by' => Auth::id(),
            'status' => Status::DRAFT
        ]);

        Notification::send($selectedUsers, new UserEnrollNotification(Auth::user(), $course));
        return back()->with('success', __('users enrolled successfully.'));
    }

    public function destroy(Request $request, Course $course)
    {
        $this->authorize('delete', $course);
        $validator = Validator::make($request->all(), [
            'userId' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::EMPLOYEE)->orWhere('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('please select at least one user!'));
        }

        $validated = $validator->validated();

        $user = User::VisibleTo()->find($validated['userId']);

        $course->enrolledUsers()->detach($validated['userId']);

        Notification::send($user, new UserUnenrollNotification(Auth::user(), $course));
        return back()->with('success', __('user unenrolled successfully.'));
    }
}
