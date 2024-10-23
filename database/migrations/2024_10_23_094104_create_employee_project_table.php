<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeProjectTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_project', function (Blueprint $table) {
            $table->id(); // Optional: you can remove this line if you don't want an auto-incrementing ID column
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            // Add unique constraint to prevent duplicates
            $table->unique(['employee_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_project');
    }
}
