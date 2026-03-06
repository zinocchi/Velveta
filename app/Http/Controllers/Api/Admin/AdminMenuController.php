<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of all menus with pagination
     */
    public function index(Request $request)
    {
        try {
            $query = Menu::query();

            if ($request->has('category') && $request->category) {
                $query->where('category', $request->category);
            }

            // Search by name or description
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }

            // Filter by stock status
            if ($request->has('stock_status')) {
                if ($request->stock_status === 'low') {
                    $query->where('stock', '<', 10)->where('stock', '>', 0);
                } elseif ($request->stock_status === 'out') {
                    $query->where('stock', '<=', 0);
                } elseif ($request->stock_status === 'available') {
                    $query->where('stock', '>', 0);
                }
            }

            // Sort
            $sortField = $request->get('sort_field', 'created_at');
            $sortDirection = $request->get('sort_direction', 'desc');
            $query->orderBy($sortField, $sortDirection);

            $menus = $query->paginate($request->get('per_page', 15));

            return response()->json([
                'success' => true,
                'message' => 'Menus retrieved successfully',
                'data' => $menus
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch menus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch menus'
            ], 500);
        }
    }

    /**
     * Store a newly created menu
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean'
        ]);

        try {
            $data = $request->except('image');

            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('menus', 'public');
                $data['image'] = $imagePath;
            }

            $data['is_available'] = $request->has('is_available') ? $request->is_available : true;

            $menu = Menu::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Menu created successfully',
                'data' => $menu
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to create menu: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create menu'
            ], 500);
        }
    }

    /**
     * Display the specified menu
     */
    public function show($id)
    {
        try {
            $menu = Menu::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Menu retrieved successfully',
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Menu not found'
            ], 404);
        }
    }

    /**
     * Update the specified menu
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'category' => 'sometimes|string|max:100',
            'stock' => 'sometimes|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean'
        ]);

        try {
            $menu = Menu::findOrFail($id);
            $data = $request->except('image');

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($menu->image) {
                    Storage::disk('public')->delete($menu->image);
                }

                $imagePath = $request->file('image')->store('menus', 'public');
                $data['image'] = $imagePath;
            }

            $menu->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Menu updated successfully',
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to update menu: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update menu'
            ], 500);
        }
    }

    /**
     * Update menu stock only
     */
    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
            'operation' => 'sometimes|in:set,add,subtract'
        ]);

        try {
            $menu = Menu::findOrFail($id);
            $operation = $request->get('operation', 'set');

            switch ($operation) {
                case 'add':
                    $menu->stock += $request->stock;
                    break;
                case 'subtract':
                    $menu->stock = max(0, $menu->stock - $request->stock);
                    break;
                case 'set':
                default:
                    $menu->stock = $request->stock;
                    break;
            }

            $menu->save();

            return response()->json([
                'success' => true,
                'message' => 'Stock updated successfully',
                'data' => [
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->name,
                    'old_stock' => $menu->getOriginal('stock'),
                    'new_stock' => $menu->stock
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to update stock: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update stock'
            ], 500);
        }
    }

    /**
     * Bulk update stock for multiple menus
     */
    public function bulkUpdateStock(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.stock' => 'required|integer|min:0',
            'items.*.operation' => 'sometimes|in:set,add,subtract'
        ]);

        try {
            $updatedItems = [];

            foreach ($request->items as $item) {
                $menu = Menu::find($item['id']);
                $operation = $item['operation'] ?? 'set';

                switch ($operation) {
                    case 'add':
                        $menu->stock += $item['stock'];
                        break;
                    case 'subtract':
                        $menu->stock = max(0, $menu->stock - $item['stock']);
                        break;
                    case 'set':
                    default:
                        $menu->stock = $item['stock'];
                        break;
                }

                $menu->save();

                $updatedItems[] = [
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->name,
                    'new_stock' => $menu->stock
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Stock updated successfully for ' . count($updatedItems) . ' items',
                'data' => $updatedItems
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to bulk update stock: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update stock'
            ], 500);
        }
    }

    /**
     * Remove the specified menu
     */
    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);

            // Check if menu has any order items
            if ($menu->orderItems()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete menu because it has associated orders'
                ], 409);
            }

            // Delete image if exists
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }

            $menu->delete();

            return response()->json([
                'success' => true,
                'message' => 'Menu deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to delete menu: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete menu'
            ], 500);
        }
    }

    /**
     * Get low stock items (stock < 10)
     */
    public function getLowStockItems()
    {
        try {
            $lowStockItems = Menu::where('stock', '<', 10)
                ->where('stock', '>', 0)
                ->orderBy('stock', 'asc')
                ->get();

            $outOfStockItems = Menu::where('stock', '<=', 0)->get();

            return response()->json([
                'success' => true,
                'message' => 'Stock status retrieved successfully',
                'data' => [
                    'low_stock' => $lowStockItems,
                    'out_of_stock' => $outOfStockItems,
                    'total_low_stock' => $lowStockItems->count(),
                    'total_out_of_stock' => $outOfStockItems->count()
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch stock status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch stock status'
            ], 500);
        }
    }

    /**
     * Get all unique categories
     */
    public function getCategories()
    {
        try {
            $categories = Menu::select('category')
                ->whereNotNull('category')
                ->distinct()
                ->orderBy('category')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Categories retrieved successfully',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch categories: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch categories'
            ], 500);
        }
    }

    /**
     * Toggle menu availability
     */
    public function toggleAvailability($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->is_available = !$menu->is_available;
            $menu->save();

            return response()->json([
                'success' => true,
                'message' => 'Menu availability toggled successfully',
                'data' => [
                    'menu_id' => $menu->id,
                    'is_available' => $menu->is_available
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to toggle availability: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle availability'
            ], 500);
        }
    }
}
