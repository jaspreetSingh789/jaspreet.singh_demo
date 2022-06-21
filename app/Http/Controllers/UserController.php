<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\MyWelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    // returns view that shows the lists of users
    public function index()
    {
        $users = User::UsersList()->get();

        return view('users.index', [
            'users' => $users
        ]);
    }

    // returns view to add a new user
    public function create()
    {
        return view('users.create', [
            'roles' => Role::get()
        ]);
    }

    // To store user and returns to users page
    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->withTrashed()->first();
        if ($user) {
            if (!$user->deleted_at) {
                return back()->with('error', __('Email already exists'));
            } else {
                $user->restore();
                $user->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'role_id' => $request->role_id
                ]);

                return back()->with('success', __('user updated successfully'));
            }
        }

        if (Auth::user()->role_id == Role::TRAINER) {
            $ids = '4';
        } elseif (Auth::user()->role_id == Role::SUB_ADMIN) {
            $ids = '3,4';
        } else {
            $ids = '1,2,3';
        }

        $roles = Role::where('slug', '!=', 'admin')->pluck('id')->toArray();

        if (!in_array($request->role_id, $roles)) {
            return redirect()->route('users.index')->with('error', __('roles does not exist'));
        }

        $attributes =  request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'role_id' => 'required',
            'email' => 'required|max:255|email|unique:users,email',
            'role_id' => 'required|in:' . $ids
        ]);

        $attributes += [
            'created_by' => Auth::id(),
        ];

        $user = User::create($attributes);

        Notification::send($user, new MyWelcomeNotification(Auth::user()));

        switch ($request->action) {
            case 'create':
                return redirect()->route('users.index')
                    ->with('success', __('User stored sucessfully'));
                break;
            case 'create_another':
                return redirect()->route('users.create')
                    ->with('success', 'Users stored successfully');
                break;
        }
    }

    //returns a editable form of user to update 
    public function edit(User $user)
    {
        if (Gate::allows('admin') || $this->authorize('update', $user)) {
            return view('users.edit', [
                'user' => $user,
                'roles' => Role::get()
            ]);
        }
    }

    //To update the existing user's details
    public function update(User $user)
    {
        if (Gate::allows('admin') || $this->authorize('update', $user)) {
            $attributes =  request()->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'role_id' => 'required',
            ]);

            $attributes['created_by'] = Auth::id();

            $user->update($attributes);
            return redirect()->route('users.index')->with('success', __('User updated sucessfully'));
        }
    }

    // To delete user and returns to users listing page
    public function delete(User $user)
    {
        if (Gate::allows('admin') || $this->authorize('delete', $user)) {
            $user->delete();
            return redirect()->route('users.index')->with('success', __('User deleted sucessfully'));
        }
    }
}
