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


     public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id', 'attendance_id');
    }

     protected $fillable = [
        'employee_number',
        'name',
        'phone_number',
        'address',
        'date_of_birth',
        'gender',
        'profile_image',
        'employee_role',
        'position_id',
        'applicant_id',
        'hire_date',
        'manager_id',
        'user_id',
        'status',
    ];

    public function events()
    {
    return $this->belongsToMany(Event::class, 'event_attendances')
                ->withPivot('status', 'check_in_time')
                ->withTimestamps();
    }
    public function user(){
        return $this->hasOne(User::class, 'employee_id');
    }
    
    public function payroll(){
        return $this->belongsTo(Payroll::class, 'employee_id');
    }

    public function performance(){
        return $this->hasMany(Performance::class, 'reviewer_id');
    }
}
