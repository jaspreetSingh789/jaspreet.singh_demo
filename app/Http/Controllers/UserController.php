<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $attributes =  request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'phone_no' => 'required|max:10|min:10',
            'city' => 'required|max:255|',
            'password' => 'required|min:6'
        ]);

        $user = User::create($attributes);

        return redirect()->route('dashboard')->with('succes', 'User stored sucessfully');
    }

    public function edit(User $user)
    {
        $users = User::find($user);

        return view('users.edit', [
            'users' => $users
        ]);
    }

    public function update(User $user)
    {
        $attributes =  request()->validate([
            'name' => 'required|max:255',
            'email' => ['required', ValidationRule::unique('users', 'email')->ignore($user->id)],
            'phone_no' => 'required|max:10|min:10',
            'city' => 'required|max:255|',
            'password' => 'required|min:6'
        ]);

        $user->update($attributes);
        return redirect()->route('dashboard')->with('succes', 'User updated sucessfully');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard')->with('succes', 'User deleted sucessfully');
    }
}
