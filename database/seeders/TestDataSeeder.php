<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test user
        $testUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create suppliers for this user
        $suppliers = [
            [
                'name' => 'Stanley Black & Decker PH',
                'email' => 'orders@stanleybnd.com.ph',
                'phone' => '+63-2-8888-1234',
                'address' => '1234 Industrial Ave, Caloocan City, Metro Manila',
                'contact_person' => 'Ramon Dela Cruz',
                'user_id' => $testUser->id,
            ],
            [
                'name' => 'Makita Tools Philippines',
                'email' => 'sales@makita.com.ph',
                'phone' => '+63-2-8555-9876',
                'address' => '56 Machineries Road, Quezon City, Metro Manila',
                'contact_person' => 'Josefina Santos',
                'user_id' => $testUser->id,
            ],
            [
                'name' => 'Bosch Power Tools Distrib.',
                'email' => 'supply@bosch-ph.com',
                'phone' => '+63-32-412-7700',
                'address' => '78 Cebu Business Park, Cebu City',
                'contact_person' => 'Eduardo Reyes',
                'user_id' => $testUser->id,
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Get the suppliers
        $stanley = Supplier::where('name', 'like', '%Stanley%')->where('user_id', $testUser->id)->first();
        $makita = Supplier::where('name', 'like', '%Makita%')->where('user_id', $testUser->id)->first();
        $bosch = Supplier::where('name', 'like', '%Bosch%')->where('user_id', $testUser->id)->first();

        // Create products for this user
        $products = [
            [
                'name' => 'Stanley FatMax Hammer 20oz',
                'sku' => 'STN-HAM-001',
                'description' => 'Fiberglass handle with anti-vibration technology. Ideal for heavy-duty nailing.',
                'price' => 899.00,
                'supplier_id' => $stanley->id,
                'user_id' => $testUser->id,
            ],
            [
                'name' => 'Stanley 25ft Tape Measure',
                'sku' => 'STN-TAP-002',
                'description' => 'Blade with standout up to 10ft. Magnetic tip for easy measuring.',
                'price' => 549.00,
                'supplier_id' => $stanley->id,
                'user_id' => $testUser->id,
            ],
            [
                'name' => 'Makita HP1631 Drill 16mm',
                'sku' => 'MKT-DRL-001',
                'description' => '710W corded drill with variable speed and reverse function.',
                'price' => 4500.00,
                'supplier_id' => $makita->id,
                'user_id' => $testUser->id,
            ],
            [
                'name' => 'Bosch GSB 550 Impact Drill',
                'sku' => 'BSC-DRL-001',
                'description' => '550W impact drill with 13mm chuck. Suitable for masonry and wood.',
                'price' => 3999.00,
                'supplier_id' => $bosch->id,
                'user_id' => $testUser->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create inventory for products
        $productsList = Product::where('user_id', $testUser->id)->get();
        foreach ($productsList as $product) {
            Inventory::create([
                'product_id' => $product->id,
                'quantity' => rand(10, 100),
                'location' => 'Shelf ' . chr(65 + rand(0, 5)) . rand(1, 5),
                'last_restocked' => now()->subDays(rand(1, 30)),
                'reorder_level' => rand(5, 20),
                'user_id' => $testUser->id,
            ]);
        }
    }
}
