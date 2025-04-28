<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ATExpert;

class ATExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experts = [
            [
                'name' => 'Eng. Youssef Al-Mahmoud',
                'expertise_area' => 'Screen Readers and Braille Displays',
                'email' => 'youssef.mahmoud@example.com',
                'phone' => '+974 5512 3456',
            ],
            [
                'name' => 'Eng. Hessa Al-Naimi',
                'expertise_area' => 'Hearing Assistive Technologies',
                'email' => 'hessa.naimi@example.com',
                'phone' => '+974 5523 4567',
            ],
            [
                'name' => 'Eng. Ali Al-Marri',
                'expertise_area' => 'Mobility Aids and Wheelchairs',
                'email' => 'ali.marri@example.com',
                'phone' => '+974 5534 5678',
            ],
            [
                'name' => 'Eng. Maha Al-Attiyah',
                'expertise_area' => 'AAC Devices',
                'email' => 'maha.attiyah@example.com',
                'phone' => '+974 5545 6789',
            ],
            [
                'name' => 'Eng. Jassim Al-Kuwari',
                'expertise_area' => 'Adaptive Switches and Controls',
                'email' => 'jassim.kuwari@example.com',
                'phone' => '+974 5556 7890',
            ],
        ];
        
        foreach ($experts as $expert) {
            ATExpert::create($expert);
        }
    }
}
