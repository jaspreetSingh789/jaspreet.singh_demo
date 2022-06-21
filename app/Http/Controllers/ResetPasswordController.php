<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function resetPassword(User $user)
    {
        return view('users.reset-password', [
            'user' => $user
        ]);
    }

    public function saveResetPassword(User $user)
    {
        $attributes = request()->validate([
            'password' => [
                'required',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'confirm_password' => 'required|same:password'
        ]);

        Notification::send($user, new ResetPasswordNotification(Auth::user(), $user->id));
        $user->update($attributes);

        return redirect()->route('users.index')->with('success', __('password reseted sucessfully'));;
    }
}
