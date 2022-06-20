<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->get();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);


        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'user_id' => Auth::id()
        ]);


        return redirect()->route('categories.index')->with('success', 'Category added successfully');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [

            'category' => $category
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $attribute = $request->validate([
            'name' => 'required',
        ]);

        $category->update($attribute);

        return redirect()->route('categories.index')->with('success', 'Categoy updated successfully');
    }

    public function delete(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoy deleted successfully');
    }
}
