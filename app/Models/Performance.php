<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{   
    protected $primaryKey = 'performance_id';

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

    public function employee(){
        return $this->hasOne(Employee::class, 'employee_id', 'reviewer_id');
    }
}
