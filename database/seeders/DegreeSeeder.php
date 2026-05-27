<?php

namespace Database\Seeders;

use App\Models\Degree;
use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            'Bachelor of Science in Information Technology',
            'Bachelor of Science in Computer Science',
            'Bachelor of Science in Information Systems',
        ] as $degreeTitle) {
            Degree::firstOrCreate([
                'degree_title' => $degreeTitle,
            ]);
        }
    }
}
