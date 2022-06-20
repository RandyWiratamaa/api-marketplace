<?php

namespace App\Http\Controllers\SuperUser;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function store(Request $request)
    {
        try {
            $roles = new Role;
            $roles->name = $request->name;

            if ($roles->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Roles added succesfully',
                    'data' => $roles
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
