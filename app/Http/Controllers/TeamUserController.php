<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Notifications\AssignedToTrainer;
use App\Notifications\AssignedUserNotification;
use App\Notifications\MyWelcomeNotification;
use App\Notifications\UnassignedFromTrainerNotification;
use App\Notifications\UnassignedUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeamUserController extends Controller
{
    public function index(User $trainer)
    {
        $this->authorize(('view'), $trainer);
        $employees = User::CreatedByAdmin()
            ->active()
            ->employee()
            ->whereDoesnthave('trainers', function ($query) use ($trainer) {
                $query->where('team_id', $trainer->id);
            })->get();

        return view('users._users-trainer', [
            'trainer' => $trainer,
            'employees' => $employees,
            'assingedUsers' => $trainer->assignedUsers()->get(),
        ]);
    }

    public function store(Request $request, User $trainer)
    {
        $this->authorize(('edit'), $trainer);

        // which user Ids we have from frontend exits in db or not.
        $validator = Validator::make($request->all(), [
            'employees' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::EMPLOYEE);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('please select at least one user!'));
        }

        $validated = $validator->validated();
        $assignees = User::VisibleTo(Auth::user())->findMany($validated['employees']);

        $trainer->assignedUsers()->attach($assignees);

        Notification::send($trainer, new AssignedUserNotification(Auth::user(), $assignees));
        Notification::send($assignees, new AssignedToTrainer(Auth::user(), $trainer));

        return redirect()->route('teams.users.index', $trainer)->with('success', __('users assigned successfully'));
    }

    public function destroy(Request $request, User $trainer)
    {
        $this->authorize(('delete'), $trainer);
        $validator = Validator::make($request->all(), [
            'userId' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::EMPLOYEE);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('please select valid user!'));
        }
        $validated = $validator->validated();

        $trainer->assignedUsers()->detach($validated['userId']);

        $assignee = User::VisibleTo(Auth::user())->find($validated['userId']);

        Notification::send($trainer, new UnassignedUserNotification(Auth::user(), $assignee));
        Notification::send($assignee, new UnassignedFromTrainerNotification(Auth::user(), $trainer));

        return redirect()->route('teams.users.index', $trainer)->with('success', __('users unassigned successfully'));
    }
}
