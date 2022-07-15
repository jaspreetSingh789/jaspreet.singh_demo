<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryStatusController extends Controller
{
    // Changes the status of category according to the input received
    public function update(Category $category)
    {
        $this->authorize('update', $category);

        if ($category->status == Category::ACTIVE) {

            $attribute['status'] = Category::INACTIVE;
        } else {
            $attribute['status'] = Category::ACTIVE;
        }

        $category->update($attribute);

        return redirect()->route('categories.index')
            ->with('success', __('category status updated successfully.'));
    }
}
