<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name'           => 'Stanley Black & Decker PH',
                'email'          => 'orders@stanleybnd.com.ph',
                'phone'          => '+63-2-8888-1234',
                'address'        => '1234 Industrial Ave, Caloocan City, Metro Manila',
                'contact_person' => 'Ramon Dela Cruz',
            ],
            [
                'name'           => 'Makita Tools Philippines',
                'email'          => 'sales@makita.com.ph',
                'phone'          => '+63-2-8555-9876',
                'address'        => '56 Machineries Road, Quezon City, Metro Manila',
                'contact_person' => 'Josefina Santos',
            ],
            [
                'name'           => 'Bosch Power Tools Distrib.',
                'email'          => 'supply@bosch-ph.com',
                'phone'          => '+63-32-412-7700',
                'address'        => '78 Cebu Business Park, Cebu City',
                'contact_person' => 'Eduardo Reyes',
            ],
            [
                'name'           => 'Ingco Hardware Supply Co.',
                'email'          => 'info@ingco-ph.com',
                'phone'          => '+63-2-8741-3300',
                'address'        => '90 Shoe Ave, Marikina City, Metro Manila',
                'contact_person' => 'Maria Villanueva',
            ],
            [
                'name'           => 'Tekiro Tools Wholesale',
                'email'          => 'wholesale@tekiro.com.ph',
                'phone'          => '+63-2-8932-5500',
                'address'        => '12 Rizal Street, Pasig City, Metro Manila',
                'contact_person' => 'Arnold Mercado',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
