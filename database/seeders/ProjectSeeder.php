<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'website',
            'description' => 'make a website for the client',
            'start' => '8-8-2024',
            'end' => '8-9-2024',
        ]);

        // You can add more employees
        Project::create([
            'title' => 'database',
            'description' => 'make a databse for the client',
            'start' => '10-8-2024',
            'end' => '10-9-2024',
        ]);
    }
}
