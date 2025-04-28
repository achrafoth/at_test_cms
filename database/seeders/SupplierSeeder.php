<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Freedom Scientific',
                'address' => '17757 US Hwy 19 N, Suite 560, Clearwater, FL 33764, USA',
                'contact_person' => 'Sales Representative',
                'phone' => '+1 800 444 4443',
                'email' => 'info@freedomscientific.com',
            ],
            [
                'name' => 'Humanware',
                'address' => '1030 René-Lévesque Blvd, Drummondville, Quebec, Canada',
                'contact_person' => 'Sales Manager',
                'phone' => '+1 800 722 3393',
                'email' => 'info@humanware.com',
            ],
            [
                'name' => 'Phonak',
                'address' => 'Laubisrütistrasse 28, 8712 Stäfa, Switzerland',
                'contact_person' => 'Regional Distributor',
                'phone' => '+41 58 928 01 01',
                'email' => 'contact@phonak.com',
            ],
            [
                'name' => 'Tobii Dynavox',
                'address' => 'Karlsrovägen 2D, 182 53 Danderyd, Sweden',
                'contact_person' => 'Middle East Sales',
                'phone' => '+46 8 663 69 90',
                'email' => 'sales.mena@tobiidynavox.com',
            ],
            [
                'name' => 'Sunrise Medical',
                'address' => '2842 Business Park Ave, Fresno, CA 93727, USA',
                'contact_person' => 'Qatar Distributor',
                'phone' => '+1 800 333 4000',
                'email' => 'qatar@sunrisemedical.com',
            ],
        ];
        
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
