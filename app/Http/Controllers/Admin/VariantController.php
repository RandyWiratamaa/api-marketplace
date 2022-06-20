<?php

namespace App\Http\Controllers\Admin;

use App\Models\Variant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VariantController extends Controller
{
    public function index()
    {
        return Variant::all();
    }

    public function store(Request $request)
    {
        try {
            $variant = new Variant;
            $variant->name = $request->name;
            if ($variant->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Variant added succesfully',
                    'data' => $variant
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
