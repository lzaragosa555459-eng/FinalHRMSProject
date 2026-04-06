<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'position_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

     public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id', 'attendance_id');
    }

     protected $fillable = [
        'employee_number',
        'name',
        'phone_number',
        'email',
        'address',
        'date_of_birth',
        'gender',
        'profile_image',
        'role',
        'department_id',
        'position_id',
        'applicant_id',
        'hire_date',
        'salary',
        'manager_id',
        'user_id',
        'status',
    ];
}
