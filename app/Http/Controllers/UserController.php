<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\MyWelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule as ValidationRule;
use phpDocumentor\Reflection\Types\Null_;

class UserController extends Controller
{
    // returns view that shows the lists of users
    public function index()
    {
        $users = User::UsersList()->get();

        // $users = User::Where('creater_id', Auth::user()->id)->get();
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

    // To store user
    // and returns to users page
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
            return redirect()->route('dashboard')->with('error', __('roles does not exist'));
        }

        $attributes =  request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'role_id' => 'required',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|in:' . $ids
        ]);

        $attributes += [
            'created_by' => Auth::id(),
        ];

        $user = User::create($attributes);

        Notification::send($user, new MyWelcomeNotification(Auth::user(), $user->id));
        return redirect()->route('dashboard')->with('succes', __('User stored sucessfully'));
    }

    //returns a editable form of user to update 
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::get()
        ]);
    }

    //To update the existing user's details
    public function update(User $user)
    {
        $attributes =  request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'role_id' => 'required',
            'email' => ['required', ValidationRule::unique('users', 'email')->ignore($user->id)],
            'phone_no' => 'required|min:10',
            'city' => 'required|max:255|',
            'password' => 'required|min:6',
            'role_id' => 'required'
        ]);

        $attributes['created_by'] = Auth::id();

        $user->update($attributes);
        return redirect()->route('dashboard')->with('succes', __('User updated sucessfully'));
    }

    // To delete user 
    // and returns to users listing page
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard')->with('succes', __('User deleted sucessfully'));
    }
}
