<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fullname',
        'dob',
        'phone',
        'gender',
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    // Put this method inside the User class
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
