<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pricelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PricelistController extends Controller
{
    public function index()
    {
        $sql = collect(Pricelist::all());
        $grouped = $sql->groupBy('product_id');
        return $grouped;
    }

    public function store(Request $request)
    {
        try {
            $pricelist = new Pricelist;
            $pricelist->product_id = $request->product_id;
            $pricelist->variant_id = $request->variant_id;
            $pricelist->price = $request->price;
            $pricelist->selling_price = $request->selling_price;

            if($pricelist->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pricelist products added succesfully',
                    'data' => $pricelist
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
