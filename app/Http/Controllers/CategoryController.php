<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Collects categories and return view to list categories
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::where('user_id', Auth::id())
                ->filter(request(['sort_by', 'search']))->paginate()
        ]);
    }

    // return view to create new category
    public function create()
    {
        return view('categories.create');
    }

    // collects data from request validate it and stores it to table
    public function store(Request $request)
    {
        $category = Category::where('name', $request->name)->onlyTrashed()->first();

        if ($category) {
            $category->restore();
            return redirect()->route('categories.index')
                ->with('success', __('category restored successfully'));
        }

        $request->validate([
            'name' => ['required', 'min:3'],
        ]);

        $category = Category::create([
            'name' => $request->name,
            'user_id' => Auth::id()
        ]);

        if ($request->input('action') === 'save') {
            return redirect()->route('categories.edit', $category)
                ->with('success', __('category added successfully'));
        }

        return redirect()->route('categories.create')
            ->with('success', __('category added successfully'));
    }

    // return a view with a editable form of the selected category
    public function edit(Category $category)
    {
        $this->authorize('edit', $category);

        return view('categories.edit', [
            'category' => $category
        ]);
    }

    // Collects the data of category from request , validate it then updates it
    public function update(Category $category, Request $request)
    {
        $this->authorize('update', $category);

        $attribute = $request->validate([
            'name' => ['required', 'min:3'],
        ]);

        $category->update($attribute);

        return redirect()->route('categories.index')
            ->with('success', __('category updated successfully'));
    }

    // Deletes the seleted categry
    public function delete(Category $category)
    {
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', __('category deleted successfully'));
    }
}
