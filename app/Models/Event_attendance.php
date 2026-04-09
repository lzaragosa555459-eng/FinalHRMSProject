<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_attendance extends Model
{
    public function employee()
    {
        return $this->hasOne(Employee::class, 'employee_id', 'employee_id');
    }
    
}
