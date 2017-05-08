<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Category;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.create_category');
    }

    public function store(Request $request)
    {
        $categories = Category::all();
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string',
        ]);

        if ($validator->fails()) 
            return ['error' => true, 'errors' => $validator->errors()->all()];

        $category = Category::create([
            'name'          => $request['name'],
        ]);

        $category->save();
        return redirect()->route('manage_categories', ['categories' => $categories]);
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        return view('admin.update_category',['category' => $category]);
        
    }

    public function update_category(Request $request,$id)
    {
        $categories = Category::all();

        $validator = Validator::make($request->all(), [
        'name'          => 'required|string',
        ]);

         $category = Category::find($id);

         $category->name = $request['name'];

         $category->save();
            
        return redirect()->route('manage_categories', ['categories' => $categories]);

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
