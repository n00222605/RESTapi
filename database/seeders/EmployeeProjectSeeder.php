<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Project;

class EmployeeProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Sample data for the pivot table
        // You can modify this as per your requirement
        $employeeProjectData = [
            [
                'employee_id' => 1, // Adjust employee ID based on your data
                'project_id' => 1,  // Adjust project ID based on your data
            ],
            [
                'employee_id' => 1,
                'project_id' => 2,
            ],
            [
                'employee_id' => 2,
                'project_id' => 1,
            ],
        ];

        // Insert data into the pivot table
        foreach ($employeeProjectData as $data) {
            DB::table('employee_project')->insert($data);
        }
    }
}
