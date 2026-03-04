<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;


class AdminMenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        return response()->json($menu);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'category' => 'required|string',
            'image_url' => 'nullable|url',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $menu = Menu::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Menu created',
            'data' => $menu
        ], 201);
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu not found'
            ], 404);
        }
        return response()->json($menu);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu not found'
            ], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|integer',
            'category' => 'sometimes|required|string',
            'image_url' => 'nullable|url',
            'stock' => 'sometimes|required|integer',
            'description' => 'nullable|string',
        ]);

        $menu->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Menu updated',
            'data' => $menu
        ]);
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu not found'
            ], 404);
        }

        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu deleted'
        ]);
    }
}
