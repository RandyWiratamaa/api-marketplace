<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        try {
            $category = new Category;
            $category->name = $request->name;

            if ($category->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category added succesfully',
                    'data' => $category
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
