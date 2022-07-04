<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseAssignController extends Controller
{
    public function index(Course $course)
    {
        // assigned trainers
        $assignedTrainers = $course->assignedTrainers()->get();

        //unassigned trainers
        $unassignedTrainers = User::whereDoesnthave('trainerCourses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->trainer()->active()->get();


        return view('courses.course-assign', [
            'assignedTrainers' => $assignedTrainers,
            'unassignedTrainers' => $unassignedTrainers,
            'course' => $course
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $this->authorize('edit', $course);
        $validator = Validator::make($request->all(), [
            'unassignedTrainerIds' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'please select at least one user!');
        }

        $validated = $validator->validated();
        $selectedUsers  = User::VisibleTo()->findMany($validated['unassignedTrainerIds']);

        $course->assignedTrainers()->attach($selectedUsers);

        return back()->with('success', 'course assigned successfully.');
    }

    public function destroy(Request $request, Course $course)
    {

        $this->authorize('delete', $course);
        $validator = Validator::make($request->all(), [
            'assignedTrainerId' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'please select at least one user!');
        }

        $validated = $validator->validated();

        $user = User::VisibleTo()->find($validated['assignedTrainerId']);

        $course->assignedTrainers()->detach($validated['assignedTrainerId']);

        return back()->with('success', 'trainer unassigned successfully.');
    }
}
