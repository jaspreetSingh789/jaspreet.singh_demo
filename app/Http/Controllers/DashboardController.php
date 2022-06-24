<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'users' => count(User::where('created_by', Auth::id())->get()),
            'categories' => count(Category::where('user_id', Auth::id())->get())
        ]);
    }
}
