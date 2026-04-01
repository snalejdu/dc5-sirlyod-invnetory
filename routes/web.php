<?php

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'stats' => [
            'total_products'   => \App\Models\Product::count(),
            'total_suppliers'  => \App\Models\Supplier::count(),
            'total_inventories'=> \App\Models\Inventory::count(),
            'total_value'      => \App\Models\Inventory::join('products', 'inventories.product_id', '=', 'products.id')
                                    ->selectRaw('SUM(inventories.quantity * products.price) as value')
                                    ->value('value') ?? 0,
        ]
    ]);
})->name('dashboard');

Route::resource('suppliers', SupplierController::class);
Route::resource('products', ProductController::class);
Route::resource('inventories', InventoryController::class);
