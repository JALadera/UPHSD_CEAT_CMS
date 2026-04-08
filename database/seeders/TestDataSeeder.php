<?php

namespace Database\Seeders;


use App\Models\Department;
use App\Models\FacultyMember;
use App\Models\NewsEvent;
use App\Models\Program;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 additional departments with related data
        Department::factory(5)
            ->has(
                Program::factory(3)
                    ->state(['is_active' => true])
            )
            ->has(FacultyMember::factory(5))

            ->has(NewsEvent::factory(4))
            ->create();



        // Create additional news and events
        NewsEvent::factory(10)->create();

        $this->command->info('Test data generated successfully!');
    }
}
