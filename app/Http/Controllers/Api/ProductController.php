<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(
            Product::where('is_active', true)->get()
        );
    }

    public function show($id)
    {
        return response()->json(
            Product::where('id', $id)
                ->where('is_active', true)
                ->firstOrFail()
        );
    }
}

