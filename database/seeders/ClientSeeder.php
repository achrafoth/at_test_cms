<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'full_name' => 'Ahmed Al-Mansour',
                'age' => 35,
                'gender' => 'male',
                'disability_type' => 'Visual Impairment',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5512 3456',
                'email' => 'ahmed.mansour@example.com',
                'status' => 'active',
            ],
            [
                'full_name' => 'Fatima Al-Thani',
                'age' => 28,
                'gender' => 'female',
                'disability_type' => 'Low Vision',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5523 4567',
                'email' => 'fatima.thani@example.com',
                'status' => 'active',
            ],
            [
                'full_name' => 'Mohammed Al-Kuwari',
                'age' => 42,
                'gender' => 'male',
                'disability_type' => 'ALS',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5534 5678',
                'email' => 'mohammed.kuwari@example.com',
                'status' => 'active',
            ],
            [
                'full_name' => 'Aisha Al-Sulaiti',
                'age' => 25,
                'gender' => 'female',
                'disability_type' => 'Hearing Impairment',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5545 6789',
                'email' => 'aisha.sulaiti@example.com',
                'status' => 'active',
            ],
            [
                'full_name' => 'Khalid Al-Attiyah',
                'age' => 55,
                'gender' => 'male',
                'disability_type' => 'Mobility Impairment',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5556 7890',
                'email' => 'khalid.attiyah@example.com',
                'status' => 'active',
            ],
            [
                'full_name' => 'Noor Al-Marri',
                'age' => 30,
                'gender' => 'female',
                'disability_type' => 'Blindness',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5567 8901',
                'email' => 'noor.marri@example.com',
                'status' => 'active',
            ],
            [
                'full_name' => 'Jassim Al-Naimi',
                'age' => 48,
                'gender' => 'male',
                'disability_type' => 'Deafness',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5578 9012',
                'email' => 'jassim.naimi@example.com',
                'status' => 'active',
            ],
            [
                'full_name' => 'Maryam Al-Khater',
                'age' => 62,
                'gender' => 'female',
                'disability_type' => 'Arthritis',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5589 0123',
                'email' => 'maryam.khater@example.com',
                'status' => 'active',
            ],
            [
                'full_name' => 'Hamad Al-Hajri',
                'age' => 10,
                'gender' => 'male',
                'disability_type' => 'Autism',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5590 1234',
                'email' => 'hamad.hajri@example.com',
                'status' => 'active',
            ],
            [
                'full_name' => 'Latifa Al-Mohannadi',
                'age' => 75,
                'gender' => 'female',
                'disability_type' => 'Dementia',
                'nationality' => 'Qatari',
                'contact_phone' => '+974 5501 2345',
                'email' => 'latifa.mohannadi@example.com',
                'status' => 'active',
            ],
        ];
        
        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
