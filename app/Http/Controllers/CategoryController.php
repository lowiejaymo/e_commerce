<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $categories = Category::when($search, function($query) use ($search) {
        return $query->where('type', 'like', "%{$search}%");
    })->get();

    return view('categories.index', compact('categories'));
}

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'type' => $request->type,
        ]);

        return redirect()->route('categories.index')->with('added_success', $category->type);
    }



    public function edit($category_id)
    {
        $category = Category::where('category_id', $category_id)->firstOrFail();
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $category_id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $category = Category::where('category_id', $category_id)->firstOrFail();
        $category->update([
            'type' => $request->type,
        ]);

        return redirect()->route('categories.index')->with('update_success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('delete_success', 'Category deleted successfully');
    }


}
