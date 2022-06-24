<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Notifications\AssignedToTrainer;
use App\Notifications\AssignedUserNotification;
use App\Notifications\MyWelcomeNotification;
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
            return back()->with('success', 'please select at least one user!');
        }

        $validated = $validator->validated();

        $assignees = User::VisibleTo(Auth::user())->findMany($validated['employees']);


        $trainer->assignedUsers()->attach($assignees);
        Notification::send($trainer, new AssignedUserNotification(Auth::user()));
        Notification::send($assignees, new AssignedToTrainer(Auth::user()));

        return redirect()->route('teams.users.index', $trainer)->with('success', 'users assigned successfully');
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
            return back()->with('success', 'please select valid user!');
        }
        $validated = $validator->validated();

        $trainer->assignedUsers()->detach($validated['userId']);

        return redirect()->route('teams.users.index', $trainer)->with('success', 'users unassigned successfully');
    }
}
