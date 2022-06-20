<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {

        return view('categories.index');
    }

    public function create()
    {

        return view('categories.create');
    }

    public function store(Category $category)
    {

        $attributes = request()->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $attributes += [
            'user_id' => Auth::id(),
        ];

        $category->create($attributes);

        return redirect()->route('categories.index')->with('success', 'Categoy added successfully');
    }
}
