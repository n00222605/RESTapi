<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'ppsn' => '123456',
            'address' => '123 Main St',
            'salary' => 50000,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        Employee::create([
            'ppsn' => '654321',
            'address' => '456 Elm St',
            'salary' => 60000,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);
    }
}
