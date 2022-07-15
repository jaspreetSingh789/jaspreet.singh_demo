<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Welcomes the user who loged in
    // shows number of users and categories
    public function index()
    {
        $user = Auth::user();
        $this->authorize('viewany', $user);
        return view('dashboard', [
            'users' => count(User::where('created_by', Auth::id())->get()),
            'categories' => count(Category::where('user_id', Auth::id())->get())
        ]);
    }
}
