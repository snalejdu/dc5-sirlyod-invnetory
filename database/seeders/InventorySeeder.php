<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $inventories = [
            ['sku' => 'STN-HAM-001', 'quantity' => 85,  'location' => 'Shelf A1', 'last_restocked' => '2026-03-01', 'reorder_level' => 20],
            ['sku' => 'STN-TAP-002', 'quantity' => 120, 'location' => 'Shelf A2', 'last_restocked' => '2026-03-05', 'reorder_level' => 30],
            ['sku' => 'STN-SCR-003', 'quantity' => 60,  'location' => 'Shelf A3', 'last_restocked' => '2026-02-20', 'reorder_level' => 15],
            ['sku' => 'MKT-DRL-001', 'quantity' => 25,  'location' => 'Shelf B1', 'last_restocked' => '2026-03-10', 'reorder_level' => 10],
            ['sku' => 'MKT-GRD-002', 'quantity' => 18,  'location' => 'Shelf B2', 'last_restocked' => '2026-03-08', 'reorder_level' => 8],
            ['sku' => 'MKT-SND-003', 'quantity' => 30,  'location' => 'Shelf B3', 'last_restocked' => '2026-02-25', 'reorder_level' => 10],
            ['sku' => 'BSC-DRL-001', 'quantity' => 22,  'location' => 'Shelf C1', 'last_restocked' => '2026-03-12', 'reorder_level' => 8],
            ['sku' => 'BSC-GRD-002', 'quantity' => 15,  'location' => 'Shelf C2', 'last_restocked' => '2026-03-07', 'reorder_level' => 5],
            ['sku' => 'BSC-LSR-003', 'quantity' => 40,  'location' => 'Shelf C3', 'last_restocked' => '2026-02-18', 'reorder_level' => 10],
            ['sku' => 'ING-PLR-001', 'quantity' => 95,  'location' => 'Shelf D1', 'last_restocked' => '2026-03-15', 'reorder_level' => 25],
            ['sku' => 'ING-WRN-002', 'quantity' => 110, 'location' => 'Shelf D2', 'last_restocked' => '2026-03-14', 'reorder_level' => 30],
            ['sku' => 'ING-HAM-003', 'quantity' => 75,  'location' => 'Shelf D3', 'last_restocked' => '2026-03-02', 'reorder_level' => 20],
            ['sku' => 'TKR-WRN-001', 'quantity' => 50,  'location' => 'Shelf E1', 'last_restocked' => '2026-03-11', 'reorder_level' => 15],
            ['sku' => 'TKR-SCK-002', 'quantity' => 35,  'location' => 'Shelf E2', 'last_restocked' => '2026-03-09', 'reorder_level' => 10],
            ['sku' => 'TKR-HEX-003', 'quantity' => 88,  'location' => 'Shelf E3', 'last_restocked' => '2026-02-28', 'reorder_level' => 20],
        ];

        foreach ($inventories as $item) {
            $product = Product::where('sku', $item['sku'])->first();
            if ($product) {
                Inventory::create([
                    'product_id'     => $product->id,
                    'quantity'       => $item['quantity'],
                    'location'       => $item['location'],
                    'last_restocked' => $item['last_restocked'],
                    'reorder_level'  => $item['reorder_level'],
                ]);
            }
        }
    }
}
