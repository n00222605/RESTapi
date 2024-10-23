<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'ppsn', 'address', 'salary', 'name', 'email', 'department_id' // Add 'department_id' here
    ];

    // Define the relationship between Employee and Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project');
    }
}
