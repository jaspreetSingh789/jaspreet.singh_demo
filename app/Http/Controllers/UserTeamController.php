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
    public function index(User $employee)
    {
        $trainers = User::active()->Trainer()
            ->whereDoesnthave('assignedUsers', function ($query) use ($employee) {
                $query->where('user_id', $employee->id);
            })->get();

        return view('users._team-assigned', [
            'trainers' => $trainers,
            'employee' => $employee,
            'assignedtrainers' => $employee->trainers()->get()
        ]);
    }

    public function store(User $employee, Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'trainerIds' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ]
        ]);
        // dd($validator);
        if ($validator->fails()) {
            return back()->with('success', 'please select at least one trainer!');
        }

        $validated = $validator->validated();
        $assignees = User::VisibleTo(Auth::user())->findMany($validated['trainerIds']);
        $employee->trainers()->attach($assignees);

        return back()->with('success', 'users assign successfully');
    }

    public function destroy(Request $request, User $employee)
    {
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
            return back()->with('success', 'please select at least one trainer!');
        }
        $validated = $validator->validated();

        $employee->assignedUsers()->detach($validated['trainerId']);

        return back()->with('success', 'trainer unassign successfully');
    }
}
