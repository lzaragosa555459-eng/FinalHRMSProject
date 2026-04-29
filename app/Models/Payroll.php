<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $primaryKey = 'payroll_id';

    protected $fillable = [
        'employee_id',
        'period_start',
        'period_end',
        'basic_salary',
        'allowances',
        'deduction',
        'net_salary',
        'pay_date',
    ];

      public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
