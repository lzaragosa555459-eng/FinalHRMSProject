<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    public function employees()
    {
        $this->hasOne(Employee::class, 'employee_id');
    }
    
    protected $fillable = [
        'employee_id',
        'review_period',
        'rating',
        'comments',
        'reviewer_id',
        'review_date',
        'status',
    ];

    
}
