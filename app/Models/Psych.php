<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Psych extends Authenticatable
{
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'psychs';

    // Fields that can be mass-assigned
    protected $fillable = [
        'full_name',
        'picture',
        'description',
        'username',
        'password',
        'average_rating',
        'rating_count',
    ];

    // Fields hidden from arrays (like password)
    protected $hidden = [
        'password',
    ];
}
