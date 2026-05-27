<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccounts extends Model
{
    protected $fillable = [
        'username', 
        'email', 
        'password', 
        'role', 
        'is_active',
        'must_change_password',
    ];
    public function students()
    {
        return $this->hasMany(Student::class, 'user_account_id', 'id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'user_account_id', 'id');
    }
}
