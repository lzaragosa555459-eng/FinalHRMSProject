<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function employees()
    {
        return $this->hasMany(Employee::class, 'position_id', 'position_id');
    }

    public function department(){
        return $this->hasOne(Department::class, 'department_id', 'department_id');
    }
}
