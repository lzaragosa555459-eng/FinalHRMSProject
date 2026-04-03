<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function employees()
    {
        return $this->hasMany(Employee::class, 'department_id', 'department_id');
    }

     public function head()
    {
        return $this->hasOne(Employee::class, 'department_id', 'department_id')
                    ->where('role', 'head');
    }
    public function events()
    {
        return $this->hasMany(Event::class, 'department_id', 'department_id');
    }

  
}
