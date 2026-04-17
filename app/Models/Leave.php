<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    protected $fillable = [
    'employee_id',
    'start_date',
    'end_date',
    'reason',
    'status',
];
}
