<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ATCategory;

class ATCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Vision',
                'parent_id' => null,
            ],
            [
                'name' => 'Hearing',
                'parent_id' => null,
            ],
            [
                'name' => 'Mobility',
                'parent_id' => null,
            ],
            [
                'name' => 'Communication',
                'parent_id' => null,
            ],
            [
                'name' => 'Cognitive',
                'parent_id' => null,
            ],
            [
                'name' => 'Screen Readers',
                'parent_id' => 1, // Vision
            ],
            [
                'name' => 'Magnifiers',
                'parent_id' => 1, // Vision
            ],
            [
                'name' => 'Braille Displays',
                'parent_id' => 1, // Vision
            ],
            [
                'name' => 'Hearing Aids',
                'parent_id' => 2, // Hearing
            ],
            [
                'name' => 'Alerting Devices',
                'parent_id' => 2, // Hearing
            ],
            [
                'name' => 'Wheelchairs',
                'parent_id' => 3, // Mobility
            ],
            [
                'name' => 'Walkers',
                'parent_id' => 3, // Mobility
            ],
            [
                'name' => 'AAC Devices',
                'parent_id' => 4, // Communication
            ],
            [
                'name' => 'Eye Tracking',
                'parent_id' => 4, // Communication
            ],
            [
                'name' => 'Memory Aids',
                'parent_id' => 5, // Cognitive
            ],
        ];
        
        foreach ($categories as $category) {
            ATCategory::create($category);
        }
    }
}
