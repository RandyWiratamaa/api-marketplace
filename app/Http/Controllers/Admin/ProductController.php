<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        try {
            $product = new Product;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->barcode = $request->barcode;
            if ($product->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product added succesfully',
                    'data' => $product
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
