<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'employee_id',
        'username',
        'email',
        'password',
        'system_role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}