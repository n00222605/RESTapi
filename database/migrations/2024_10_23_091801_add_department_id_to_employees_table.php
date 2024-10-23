<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentIdToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Drop the column if it exists to avoid duplicate column errors
            if (Schema::hasColumn('employees', 'department_id')) {
                $table->dropForeign(['department_id']); // Drop foreign key if it exists
                $table->dropColumn('department_id');    // Drop the column
            }

            // Now add the department_id column
            $table->unsignedBigInteger('department_id')->nullable(); // Add department_id column
            
            // Set up foreign key
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade'); // Set up foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department_id']); // Drop foreign key
            $table->dropColumn('department_id');    // Drop the column
        });
    }
}
