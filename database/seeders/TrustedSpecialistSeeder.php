<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TrustedSpecialist;

class TrustedSpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialists = [
            [
                'name' => 'Dr. Ahmed Al-Khalifa',
                'specialization' => 'Visual Impairment Specialist',
                'email' => 'ahmed.khalifa@example.com',
                'phone' => '+974 5512 3456',
            ],
            [
                'name' => 'Dr. Fatima Al-Mansouri',
                'specialization' => 'Hearing Impairment Specialist',
                'email' => 'fatima.mansouri@example.com',
                'phone' => '+974 5598 7654',
            ],
            [
                'name' => 'Dr. Mohammed Al-Thani',
                'specialization' => 'Mobility Impairment Specialist',
                'email' => 'mohammed.thani@example.com',
                'phone' => '+974 5534 5678',
            ],
            [
                'name' => 'Dr. Sara Al-Jaber',
                'specialization' => 'Learning Disability Specialist',
                'email' => 'sara.jaber@example.com',
                'phone' => '+974 5567 8901',
            ],
            [
                'name' => 'Dr. Khalid Al-Sulaiti',
                'specialization' => 'Speech Impairment Specialist',
                'email' => 'khalid.sulaiti@example.com',
                'phone' => '+974 5523 4567',
            ],
            [
                'name' => 'Dr. Noura Al-Kubaisi',
                'specialization' => 'Cognitive Disability Specialist',
                'email' => 'noura.kubaisi@example.com',
                'phone' => '+974 5545 6789',
            ],
        ];
        
        foreach ($specialists as $specialist) {
            TrustedSpecialist::create($specialist);
        }
    }
}
