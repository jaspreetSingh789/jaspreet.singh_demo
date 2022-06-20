<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    public function update(User $user)
    {
        if ($user->status == USER::INACTIVE) {
            $attribute['status'] = USER::ACTIVE;
        } else {
            $attribute['status'] = USER::INACTIVE;
        }

        $user->update($attribute);

        return redirect()->route('dashboard')->with('success', __('Status updated sucessfully'));
    }
}
