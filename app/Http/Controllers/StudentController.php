<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $users = Student::get();
        return view('dashboard', [
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
            'phone' => 'required|max:10|min:10',
            'city' => 'required|max:255|'
        ]);

        // var_dump($attributes);
        // die;

        $user = Student::create($attributes);
        // session()->flash('success', 'Your account has been created');

        return redirect('/dashboard');
    }

    public function edit(Student $user)
    {

        $users = Student::find($user);

        return view('users.edit', [
            'users' => $users
        ]);
    }

    public function update(Student $user)
    {
        $attributes =  request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'phone' => 'required|max:10|min:10',
            'city' => 'required|max:255|'
        ]);

        $user->update($attributes);

        return redirect('/dashboard');
    }

    public function delete(Student $user)
    {

        $user->delete();

        return redirect('/dashboard');
    }
}
