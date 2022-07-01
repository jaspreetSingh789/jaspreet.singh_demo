<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\AssignedTeamUserNotification;
use App\Notifications\AssignedToTeamNotification;
use App\Notifications\UnAssignedFromTeamNotification;
use App\Notifications\UnAssignedTeamUserNotification;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class UserTeamController extends Controller
{
    public function index(User $user)
    {
        $this->authorize(('view'), $user);
        $trainers = User::active()->Trainer()
            ->whereDoesnthave('assignedUsers', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

        return view('users._team-assigned', [
            'trainers' => $trainers,
            'user' => $user,
            'assignedtrainers' => $user->trainers()->get()
        ]);
    }

    public function store(User $user, Request $request)
    {
        $this->authorize(('view'), $user);
        $validator = Validator::make($request->all(), [
            'trainerIds' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ]
        ]);

        if ($validator->fails()) {
            return back()->with('success', 'please select at least one trainer!');
        }

        $validated = $validator->validated();
        $assignees = User::VisibleTo(Auth::user())->findMany($validated['trainerIds']);
        $user->trainers()->attach($assignees);

        Notification::send($assignees, new AssignedTeamUserNotification(Auth::user(), $user));
        Notification::send($user, new AssignedToTeamNotification(Auth::user(), $assignees));

        return back()->with('success', 'trainer assign successfully');
    }

    public function destroy(Request $request, User $user)
    {
        $this->authorize(('delete'), $user);

        $validator = Validator::make($request->all(), [
            'trainerId' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'please select a valid trainer !');
        }
        $validated = $validator->validated();

        $user->trainers()->detach($validated['trainerId']);

        $assignee = User::VisibleTo(Auth::user())->find($validated['trainerId']);

        Notification::send($assignee, new UnAssignedTeamUserNotification(Auth::user(), $user));
        Notification::send($user, new UnAssignedFromTeamNotification(Auth::user(), $assignee));

        return back()->with('success', 'trainer unassign successfully');
    }
}
