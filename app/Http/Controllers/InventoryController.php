<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::where('user_id', Auth::id())
            ->with('product')
            ->paginate(10);
        return Inertia::render('Inventories/Index', [
            'inventories' => $inventories
        ]);
    }

    public function create()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return Inertia::render('Inventories/Create', [
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id|unique:inventories,product_id',
            'quantity' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'last_restocked' => 'required|date',
            'reorder_level' => 'required|integer|min:0',
        ]);

        $validated['user_id'] = Auth::id();
        Inventory::create($validated);

        return redirect()->route('inventories.index')
            ->with('message', 'Inventory created successfully');
    }

    public function edit(Inventory $inventory)
    {
        $this->authorize('view', $inventory);

        $products = Product::where('user_id', Auth::id())->get();
        return Inertia::render('Inventories/Edit', [
            'inventory' => $inventory->load('product'),
            'products' => $products
        ]);
    }

    public function update(Request $request, Inventory $inventory)
    {
        $this->authorize('update', $inventory);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id|unique:inventories,product_id,' . $inventory->id,
            'quantity' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'last_restocked' => 'required|date',
            'reorder_level' => 'required|integer|min:0',
        ]);

        $inventory->update($validated);

        return redirect()->route('inventories.index')
            ->with('message', 'Inventory updated successfully');
    }

    public function destroy(Inventory $inventory)
    {
        $this->authorize('delete', $inventory);
        $inventory->delete();

        return redirect()->route('inventories.index')
            ->with('message', 'Inventory deleted successfully');
    }
}
