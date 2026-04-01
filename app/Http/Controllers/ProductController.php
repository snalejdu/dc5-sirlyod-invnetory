<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::id())
            ->with(['supplier', 'inventory'])
            ->paginate(10);
        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $suppliers = Supplier::where('user_id', Auth::id())->get();
        return Inertia::render('Products/Create', [
            'suppliers' => $suppliers
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $validated['user_id'] = Auth::id();
        Product::create($validated);

        return redirect()->route('products.index')
            ->with('message', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $this->authorize('view', $product);
        $suppliers = Supplier::where('user_id', Auth::id())->get();
        return Inertia::render('Products/Edit', [
            'product' => $product->load('supplier'),
            'suppliers' => $suppliers
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('message', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()->route('products.index')
            ->with('message', 'Product deleted successfully');
    }
}
