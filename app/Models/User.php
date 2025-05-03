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
    public function streakLogs()
{
    return $this->hasMany(StreakLog::class);
}

public function getCurrentStreak($type)
{
    return $this->{"{$type}_streak"};
}
}
