<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index() {
        return response()->json(Brand::all(), 200);
    }

    public function store(Request $request) {
        $brand = Brand::create($request->all());
        return response()->json($brand, 201);
    }

    public function show($id) {
        $brand = Brand::find($id);
        return $brand ? response()->json($brand, 200) : response()->json(['message' => 'Brand not found'], 404);
    }

    public function update(Request $request, $id) {
        $brand = Brand::find($id);
        if ($brand) {
            $brand->update($request->all());
            return response()->json($brand, 200);
        }
        return response()->json(['message' => 'Brand not found'], 404);
    }

    public function destroy($id) {
        $brand = Brand::find($id);
        if ($brand) {
            $brand->delete();
            return response()->json(['message' => 'Brand deleted'], 200);
        }
        return response()->json(['message' => 'Brand not found'], 404);
    }
}