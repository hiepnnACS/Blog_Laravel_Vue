<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function getCategory()
    {
        $category = Category::all();
        return response()->json([
            'categories' => $category
        ], 200);
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'cate_name' => 'required|min:2|max:50'
        ]);
        $category = new Category;
        $category->cat_name = $request->cate_name;
        $category->save();

        return ['message' => 'ok'];
        
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
    }

    public function editCategory($id) 
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'category' => $category
        ], 200);
    }

    public function updateCategory($id, Request $request)
    {
        $this->validate($request, [
            'cat_name' => 'required|min:2|max:50'
        ]);
        $category = Category::findOrFail($id);
        $category->cat_name = $request->cat_name;
        $category->save();

        return ['message' => 'ok'];
    }
}
