<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\Client;
use App\Models\ATEquipment;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loans = [
            [
                'client_id' => 6, // Noor Al-Marri
                'at_equipment_id' => 2, // Focus 40 Blue Braille Display
                'start_date' => Carbon::now()->subDays(45),
                'expected_return_date' => Carbon::now()->addDays(45),
                'actual_return_date' => null,
                'status' => 'on_loan',
                'notes' => 'Loaned for 90-day trial period to evaluate effectiveness.',
            ],
            [
                'client_id' => 7, // Jassim Al-Naimi
                'at_equipment_id' => 5, // Vibrating Alarm Clock
                'start_date' => Carbon::now()->subDays(60),
                'expected_return_date' => Carbon::now()->subDays(30),
                'actual_return_date' => Carbon::now()->subDays(28),
                'status' => 'returned',
                'notes' => 'Client returned device after successful trial period. Decided to purchase their own.',
            ],
            [
                'client_id' => 8, // Maryam Al-Khater
                'at_equipment_id' => 7, // Rollator Walker
                'start_date' => Carbon::now()->subDays(90),
                'expected_return_date' => Carbon::now()->subDays(60),
                'actual_return_date' => null,
                'status' => 'lost',
                'notes' => 'Client reported device was lost during travel. Case closed after investigation.',
            ],
            [
                'client_id' => 9, // Hamad Al-Hajri
                'at_equipment_id' => 9, // GoTalk 32+
                'start_date' => Carbon::now()->subDays(30),
                'expected_return_date' => Carbon::now()->addDays(30),
                'actual_return_date' => null,
                'status' => 'on_loan',
                'notes' => 'Loaned for evaluation before recommending purchase.',
            ],
            [
                'client_id' => 10, // Latifa Al-Mohannadi
                'at_equipment_id' => 10, // MemoPlanner
                'start_date' => Carbon::now()->subDays(15),
                'expected_return_date' => Carbon::now()->addDays(15),
                'actual_return_date' => null,
                'status' => 'on_loan',
                'notes' => 'Short-term loan to assist with memory training program.',
            ],
        ];
        
        foreach ($loans as $loan) {
            Loan::create($loan);
        }
    }
}
