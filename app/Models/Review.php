<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // app/Models/Review.php
    protected $fillable = ['name', 'rating', 'review'];
}
