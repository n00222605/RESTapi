<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'title' => 'front end',
            'location' => '123 Main St',
            'website' => 'www.frontend.com',
        ]);

        Department::create([
            'title' => 'database',
            'location' => '321 Main St',
            'website' => 'www.database.com',
        ]);
    }
}
