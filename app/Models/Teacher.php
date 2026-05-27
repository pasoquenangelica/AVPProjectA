<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'contactno',
        'user_account_id',
    ];

    public function userAccount()
    {
        return $this->belongsTo(UserAccounts::class, 'user_account_id', 'id');
    }
}
