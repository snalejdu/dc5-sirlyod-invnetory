<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $stanley  = Supplier::where('name', 'like', '%Stanley%')->first();
        $makita   = Supplier::where('name', 'like', '%Makita%')->first();
        $bosch    = Supplier::where('name', 'like', '%Bosch%')->first();
        $ingco    = Supplier::where('name', 'like', '%Ingco%')->first();
        $tekiro   = Supplier::where('name', 'like', '%Tekiro%')->first();

        $products = [
            // Stanley
            [
                'name'        => 'Stanley FatMax Hammer 20oz',
                'sku'         => 'STN-HAM-001',
                'description' => 'Fiberglass handle with anti-vibration technology. Ideal for heavy-duty nailing.',
                'price'       => 899.00,
                'supplier_id' => $stanley->id,
            ],
            [
                'name'        => 'Stanley 25ft Tape Measure',
                'sku'         => 'STN-TAP-002',
                'description' => 'Blade with standout up to 10ft. Magnetic tip for easy measuring.',
                'price'       => 549.00,
                'supplier_id' => $stanley->id,
            ],
            [
                'name'        => 'Stanley 12-Piece Screwdriver Set',
                'sku'         => 'STN-SCR-003',
                'description' => 'Phillips and flathead screwdrivers with cushioned grip handles.',
                'price'       => 1250.00,
                'supplier_id' => $stanley->id,
            ],

            // Makita
            [
                'name'        => 'Makita HP1631 Drill 16mm',
                'sku'         => 'MKT-DRL-001',
                'description' => '710W corded drill with variable speed and reverse function.',
                'price'       => 4500.00,
                'supplier_id' => $makita->id,
            ],
            [
                'name'        => 'Makita 9553B Angle Grinder 4"',
                'sku'         => 'MKT-GRD-002',
                'description' => '840W angle grinder with 11,000 RPM. Includes grinding disc.',
                'price'       => 3200.00,
                'supplier_id' => $makita->id,
            ],
            [
                'name'        => 'Makita BO4556 Finishing Sander',
                'sku'         => 'MKT-SND-003',
                'description' => '200W sander with dust collection bag. Ideal for wood finishing.',
                'price'       => 2800.00,
                'supplier_id' => $makita->id,
            ],

            // Bosch
            [
                'name'        => 'Bosch GSB 550 Impact Drill',
                'sku'         => 'BSC-DRL-001',
                'description' => '550W impact drill with 13mm chuck. Suitable for masonry and wood.',
                'price'       => 3999.00,
                'supplier_id' => $bosch->id,
            ],
            [
                'name'        => 'Bosch GWS 060 Angle Grinder 4"',
                'sku'         => 'BSC-GRD-002',
                'description' => '670W angle grinder with spindle lock for quick disc changes.',
                'price'       => 2750.00,
                'supplier_id' => $bosch->id,
            ],
            [
                'name'        => 'Bosch GLM 20 Laser Measure',
                'sku'         => 'BSC-LSR-003',
                'description' => 'Measures up to 20m with ±3mm accuracy. Compact pocket size.',
                'price'       => 2199.00,
                'supplier_id' => $bosch->id,
            ],

            // Ingco
            [
                'name'        => 'Ingco 4-Piece Plier Set',
                'sku'         => 'ING-PLR-001',
                'description' => 'Includes long nose, combination, slip joint, and diagonal pliers.',
                'price'       => 780.00,
                'supplier_id' => $ingco->id,
            ],
            [
                'name'        => 'Ingco 6" Adjustable Wrench',
                'sku'         => 'ING-WRN-002',
                'description' => 'Chrome vanadium steel with precision-ground jaw.',
                'price'       => 320.00,
                'supplier_id' => $ingco->id,
            ],
            [
                'name'        => 'Ingco 16oz Claw Hammer',
                'sku'         => 'ING-HAM-003',
                'description' => 'Drop-forged steel head with wooden handle.',
                'price'       => 420.00,
                'supplier_id' => $ingco->id,
            ],

            // Tekiro
            [
                'name'        => 'Tekiro 10-Piece Combination Wrench Set',
                'sku'         => 'TKR-WRN-001',
                'description' => 'Chrome vanadium steel, sizes 8mm to 19mm.',
                'price'       => 1100.00,
                'supplier_id' => $tekiro->id,
            ],
            [
                'name'        => 'Tekiro 1/2" Drive Socket Set 24pcs',
                'sku'         => 'TKR-SCK-002',
                'description' => 'Metric socket set with ratchet handle and extension bar.',
                'price'       => 1850.00,
                'supplier_id' => $tekiro->id,
            ],
            [
                'name'        => 'Tekiro Hex Key Allen Wrench Set',
                'sku'         => 'TKR-HEX-003',
                'description' => '9-piece set, 1.5mm to 10mm. Chrome vanadium steel.',
                'price'       => 480.00,
                'supplier_id' => $tekiro->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Generate additional products using factory for variety
        Product::factory(20)->create();
    }
}
