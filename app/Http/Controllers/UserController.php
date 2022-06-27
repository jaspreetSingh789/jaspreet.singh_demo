<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Notifications\MyWelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    // Collects users from users table and returns to view that shows lists of those users
    public function index()
    {
        // if (request('search')) {
        //     return view('users.index', [
        //         'users' => User::where('first_name', 'like', '%' . request('search') . '%')->paginate(5)
        //     ]);
        // }
        return view('users.index', [
            'users' => User::filter(request(['user_type', 'date_filter', 'search']))->paginate(5)
        ]);
    }

    // Returns a view which shows a form to create new user
    public function create()
    {
        return view('users.create', [
            'roles' => Role::get()
        ]);
    }

    // Collects the data from request, validate it and returns back
    public function store(Request $request)
    {
        // Restores the user if the email sent from request already exits in table 
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

        // To check that the role coming from requist is valid or not
        if (Auth::user()->role_id == Role::TRAINER) {
            $ids = '4';
        } elseif (Auth::user()->role_id == Role::SUB_ADMIN) {
            $ids = '3,4';
        } else {
            $ids = '2,3,4';
        }

        $roles = Role::where('slug', '!=', 'admin')->pluck('id')->toArray();
        if (!in_array($request->role_id, $roles)) {
            return redirect()->route('users.index')->with('error', __('entered role does not exist'));
        }

        // Validate the data from request
        $attributes =  request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'role_id' => 'required',
            'email' => 'required|max:255|email|unique:users,email',
            'role_id' => 'required|in:' . $ids
        ]);

        // adding created by id of auth user to attributes 
        $attributes += [
            'created_by' => Auth::id(),
        ];

        // If every is validated user will be created 
        $user = User::create($attributes);

        // To create team 
        if ($user->role_id != Role::SUB_ADMIN) {
            Team::create([
                'team_id' => Auth::id(),
                'user_id' => $user->id,
            ]);
        }

        // sends notification to user to invite him to the application and set his password
        Notification::send($user, new MyWelcomeNotification(Auth::user()));

        //   Return page according to the button which was clicked during submitting request
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
            return view('users._personal-information', [
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
            return redirect()->route('users.index')->with('error', __('User deleted sucessfully'));
        }
    }
}
