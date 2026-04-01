<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Policies\ProductPolicy;
use App\Policies\SupplierPolicy;
use App\Policies\InventoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        Supplier::class => SupplierPolicy::class,
        Inventory::class => InventoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}