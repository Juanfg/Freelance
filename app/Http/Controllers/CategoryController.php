<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.create_category');
    }

    public function store(Request $request)
    {

    }

    public function getAllCategories()
    {
        $categories = Category::all();
        return view('admin.manage_categories',['categories' => $categories]);
    }

    public function activateCategory($id)
    {
        $categories = Category::all();
        $category = Category::find($id);
        $category->active = true;
        $category->save();
        return redirect()->route('manage_categories', ['categories' => $categories]);
    }

    public function deactivateCategory($id)
    {
        $categories = Category::all();
        $category = Category::find($id);
        $category->active = false;
        $category->save();
        return redirect()->route('manage_categories', ['categories' => $categories]);
    }
}
