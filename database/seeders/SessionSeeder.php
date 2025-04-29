<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientSession;
use App\Models\TrustedSpecialist;
use App\Models\ATExpert;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        $specialists = TrustedSpecialist::all();
        $experts = ATExpert::all();
        $sessionTypes = ['Assessment', 'Training', 'Device Setup', 'Follow-up'];
        
        for ($i = 0; $i < 10; $i++) {
            $client = $clients->random();
            $specialist = $specialists->random();
            $expert = $i % 2 === 0 ? $experts->random() : null; // Only assign expert to half of the sessions
            
            ClientSession::create([
                'client_id' => $client->id,
                'trusted_specialist_id' => $specialist->id,
                'at_expert_id' => $expert ? $expert->id : null,
                'session_type' => $sessionTypes[array_rand($sessionTypes)],
                'session_date' => Carbon::now()->addDays(rand(-30, 30))->addHours(rand(9, 17)),
                'session_duration' => rand(30, 120),
                'notes' => $i % 3 === 0 ? 'Sample session notes for ' . $client->full_name : null,
                'outcome' => $i % 4 === 0 ? 'Sample outcome for ' . $client->full_name : null,
            ]);
        }
    }
}
