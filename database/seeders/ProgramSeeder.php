<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'name' => 'BS Information Technology',
                'code' => 'BSIT',
                'description' => '4-year bachelor degree program in Information Technology',
                'duration_years' => 4,
                'total_seats' => 50,
                'application_start_date' => now(),
                'application_end_date' => now()->addMonths(2),
                'is_active' => true
            ],
            [
                'name' => 'BS Computer Science',
                'code' => 'BSCS',
                'description' => '4-year bachelor degree program in Computer Science',
                'duration_years' => 4,
                'total_seats' => 40,
                'application_start_date' => now(),
                'application_end_date' => now()->addMonths(2),
                'is_active' => true
            ],
            [
                'name' => 'BS Software Engineering',
                'code' => 'BSSE',
                'description' => '4-year bachelor degree program in Software Engineering',
                'duration_years' => 4,
                'total_seats' => 30,
                'application_start_date' => now(),
                'application_end_date' => now()->addMonths(2),
                'is_active' => true
            ]
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}