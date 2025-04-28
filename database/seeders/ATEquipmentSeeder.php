<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ATEquipment;

class ATEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipment = [
            [
                'name' => 'JAWS Screen Reader',
                'model' => '2023 Professional',
                'description' => 'Screen reading software for Windows computers',
                'category_id' => 6, // Screen Readers
                'supplier_id' => 1, // Freedom Scientific
                'serial_number' => 'JAWS-2023-001',
                'quantity' => 5,
            ],
            [
                'name' => 'Focus 40 Blue',
                'model' => '5th Generation',
                'description' => 'Refreshable Braille display with Bluetooth',
                'category_id' => 8, // Braille Displays
                'supplier_id' => 1, // Freedom Scientific
                'serial_number' => 'F40B-5G-001',
                'quantity' => 3,
            ],
            [
                'name' => 'Handheld Digital Magnifier',
                'model' => 'Explore 8',
                'description' => 'Portable electronic magnifier with 8-inch screen',
                'category_id' => 7, // Magnifiers
                'supplier_id' => 2, // Humanware
                'serial_number' => 'EXP8-001',
                'quantity' => 7,
            ],
            [
                'name' => 'Phonak Naída Paradise',
                'model' => 'P-UP',
                'description' => 'Power hearing aid for severe to profound hearing loss',
                'category_id' => 9, // Hearing Aids
                'supplier_id' => 3, // Phonak
                'serial_number' => 'PNP-001',
                'quantity' => 10,
            ],
            [
                'name' => 'Vibrating Alarm Clock',
                'model' => 'Sonic Bomb',
                'description' => 'Alarm clock with bed shaker for deaf users',
                'category_id' => 10, // Alerting Devices
                'supplier_id' => 3, // Phonak
                'serial_number' => 'SB-001',
                'quantity' => 8,
            ],
            [
                'name' => 'Lightweight Wheelchair',
                'model' => 'Quickie 2',
                'description' => 'Folding manual wheelchair with adjustable features',
                'category_id' => 11, // Wheelchairs
                'supplier_id' => 5, // Sunrise Medical
                'serial_number' => 'Q2-001',
                'quantity' => 4,
            ],
            [
                'name' => 'Rollator Walker',
                'model' => 'Breezy',
                'description' => 'Four-wheel walker with seat and basket',
                'category_id' => 12, // Walkers
                'supplier_id' => 5, // Sunrise Medical
                'serial_number' => 'BRZ-001',
                'quantity' => 6,
            ],
            [
                'name' => 'Tobii Dynavox I-Series',
                'model' => 'I-13',
                'description' => 'Eye-tracking communication device with 13-inch screen',
                'category_id' => 14, // Eye Tracking
                'supplier_id' => 4, // Tobii Dynavox
                'serial_number' => 'TD-I13-001',
                'quantity' => 2,
            ],
            [
                'name' => 'GoTalk 32+',
                'model' => '2023',
                'description' => 'Speech output device with 32 message locations',
                'category_id' => 13, // AAC Devices
                'supplier_id' => 4, // Tobii Dynavox
                'serial_number' => 'GT32-001',
                'quantity' => 5,
            ],
            [
                'name' => 'MemoPlanner',
                'model' => 'Digital Calendar',
                'description' => 'Digital calendar for memory support',
                'category_id' => 15, // Memory Aids
                'supplier_id' => 4, // Tobii Dynavox
                'serial_number' => 'MP-001',
                'quantity' => 3,
            ],
        ];
        
        foreach ($equipment as $item) {
            ATEquipment::create($item);
        }
    }
}
