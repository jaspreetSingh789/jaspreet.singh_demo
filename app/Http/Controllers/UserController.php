<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule as ValidationRule;

class UserController extends Controller
{
    // returns view that shows the lists of users
    public function index()
    {
        $users = User::visibleTo()->get();
        return view('users.index', [
            'users' => $users
        ]);
    }

    // returns view to add a new user
    public function create()
    {
        $roles = Role::get();
        return view('users.create', [
            'roles' => $roles
        ]);
    }

    // To store user
    // and returns to users page
    public function store()
    {
        $attributes =  request()->validate([
            'name' => 'required|max:255',
            'role_id' => 'required',
            'email' => 'required|max:255|email|unique:users,email',
            'phone_no' => 'required|max:10|min:10',
            'city' => 'required|max:255|',
            'password' => 'required|min:6',
            'role_id' => 'required'
        ]);

        User::create($attributes);
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
            'name' => 'required|max:255',
            'role_id' => 'required',
            'email' => ['required', ValidationRule::unique('users', 'email')->ignore($user->id)],
            'phone_no' => 'required|min:10',
            'city' => 'required|max:255|',
            'password' => 'required|min:6',
            'role_id' => 'required'
        ]);

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
