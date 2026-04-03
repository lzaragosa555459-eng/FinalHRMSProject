<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title',
        'start_datetime',
        'end_datetime',
        'location',
        'department_id',
        'description',
        'event_type',
        'max_participants',
        'status'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }
}
