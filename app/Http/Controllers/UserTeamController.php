<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return back()->with('success', 'please select a valid trainer !');
        }
        $validated = $validator->validated();

        $user->assignedUsers()->detach($validated['trainerId']);

        return back()->with('success', 'trainer unassign successfully');
    }
}
