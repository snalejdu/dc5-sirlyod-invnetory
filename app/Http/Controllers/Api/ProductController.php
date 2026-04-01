<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get CRUD links from cache
     */
    protected function getCrudLinks()
    {
        return cache()->get('crud_links_products', [
            'list' => config('app.url') . '/api/v1/products',
            'create' => config('app.url') . '/api/v1/products',
            'view' => config('app.url') . '/api/v1/products/{id}',
            'update' => config('app.url') . '/api/v1/products/{id}',
            'delete' => config('app.url') . '/api/v1/products/{id}',
        ]);
    }

    /**
     * List all products (protected)
     */
    public function index(Request $request)
    {
        $products = Product::with(['supplier', 'inventory'])
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
            'links' => $this->getCrudLinks(),
        ]);
    }

    /**
     * Show single product (protected)
     */
    public function show($id)
    {
        $product = Product::with(['supplier', 'inventory'])->findOrFail($id);

        return response()->json([
            'data' => $product,
            'links' => $this->getCrudLinks(),
        ]);
    }

    /**
     * Store a new product (protected)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product->load(['supplier', 'inventory']),
            'links' => $this->getCrudLinks(),
        ], 201);
    }

    /**
     * Update a product (protected)
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'sku' => 'sometimes|required|string|unique:products,sku,' . $id,
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product->load(['supplier', 'inventory']),
            'links' => $this->getCrudLinks(),
        ]);
    }

    /**
     * Delete a product (protected)
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
            'links' => $this->getCrudLinks(),
        ]);
    }

    /**
     * List all products publicly (public - no authentication required)
     */
    public function publicIndex(Request $request)
    {
        $products = Product::with(['supplier', 'inventory'])
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
            'message' => 'Products retrieved successfully',
        ]);
    }

    /**
     * Show single product publicly (public - no authentication required)
     */
    public function publicShow($id)
    {
        $product = Product::with(['supplier', 'inventory'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product retrieved successfully',
        ]);
    }
}
