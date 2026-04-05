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
//The $this->hasOne or hasMany, is elequent relatioship that defines the relationship between tables. 

// In Laravel:

// hasOne()  = one-to-one relationship
// hasMany() = one-to-many relationship
// belongsTo() = inverse (child side)

// POST MODEL (Child)
//public function user()
//{
    // Each post belongs to one user
    //return $this->belongsTo(User::class);
//}

// Meaning:
// User → many Posts
// Post → belongs to one User