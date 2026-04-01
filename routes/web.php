<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return Inertia::render('Landing');
})->name('landing');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'handleRegister']);

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'stats' => [
                'total_products'   => \App\Models\Product::where('user_id', Auth::id())->count(),
                'total_suppliers'  => \App\Models\Supplier::where('user_id', Auth::id())->count(),
                'total_inventories'=> \App\Models\Inventory::where('user_id', Auth::id())->count(),
                'total_value'      => \App\Models\Inventory::where('inventories.user_id', Auth::id())
                                        ->join('products', 'inventories.product_id', '=', 'products.id')
                                        ->selectRaw('SUM(inventories.quantity * products.price) as value')
                                        ->value('value') ?? 0,
            ]
        ]);
    })->name('dashboard');

    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    Route::resource('inventories', InventoryController::class);
});
