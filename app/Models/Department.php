<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $primaryKey = 'department_id';

    protected $fillable = [
        'department_number',
        'name',
        'description',
    ];
    
    public function events()
    {
        return $this->hasMany(Event::class, 'department_id', 'department_id');
    }

    public function position(){
        return $this->hasMany(Position::class, 'department_id');
    }

    public function employees()
    {
        return $this->hasManyThrough(
            Employee::class,
            Position::class,
            'department_id',   // positions.department_id
            'position_id',     // employees.position_id
            'department_id',   // departments.department_id (IMPORTANT FIX)
            'position_id'      // positions.position_id (NOT id if custom)
        );
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