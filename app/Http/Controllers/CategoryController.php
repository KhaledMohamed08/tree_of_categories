<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('index', compact('categories'));
    }

    public function getSubCategoriesByParentId($id)
    {
        $subCategories = Category::where('parent_id', $id)->get();

        return response()->json($subCategories);
    }

    public function postSubCategories($id)
    {
        $parentCategory = Category::where('id', $id)->first();
        $subCategories = Category::where('parent_id', $parentCategory->id)->count();
        if ($subCategories < 1){
            for ($i = 0; $i<3; $i++){
                $subCategory = new Category();
                $subCategory->parent_id = $id;
                $subCategory->name = 'SUB ' . $parentCategory->name . $i + 1;
                $subCategory->save();
            }
        }

        return response()->json();
    }

}
