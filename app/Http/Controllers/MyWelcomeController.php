<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MyWelcomeController extends Controller
{
    public function showWelcomePage(User $user)
    {
        return view('emails.my-welcome-page', [
            'user' => $user,
        ]);
    }

    public function savePassword(User $user)
    {
        $attributes = request()->validate([
            'password' => 'required'
        ]);
        $user->update($attributes);

        return redirect()->route('login');
    }
}