<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provision;
use App\Models\Client;
use App\Models\ATEquipment;
use Carbon\Carbon;

class ProvisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provisions = [
            [
                'client_id' => 1, // Ahmed Al-Mansour
                'at_equipment_id' => 1, // JAWS Screen Reader
                'provision_date' => Carbon::now()->subDays(30),
                'notes' => 'Provided for home use to assist with computer accessibility.',
            ],
            [
                'client_id' => 2, // Fatima Al-Thani
                'at_equipment_id' => 3, // Handheld Digital Magnifier
                'provision_date' => Carbon::now()->subDays(25),
                'notes' => 'Client requested this device for reading printed materials.',
            ],
            [
                'client_id' => 3, // Mohammed Al-Kuwari
                'at_equipment_id' => 8, // Tobii Dynavox I-Series
                'provision_date' => Carbon::now()->subDays(20),
                'notes' => 'Eye-tracking device provided to assist with communication.',
            ],
            [
                'client_id' => 4, // Aisha Al-Sulaiti
                'at_equipment_id' => 4, // Phonak Naída Paradise
                'provision_date' => Carbon::now()->subDays(15),
                'notes' => 'Hearing aid provided after assessment by AT Expert.',
            ],
            [
                'client_id' => 5, // Khalid Al-Attiyah
                'at_equipment_id' => 6, // Lightweight Wheelchair
                'provision_date' => Carbon::now()->subDays(10),
                'notes' => 'Wheelchair provided for mobility assistance.',
            ],
        ];
        
        foreach ($provisions as $provision) {
            Provision::create($provision);
        }
    }
}
