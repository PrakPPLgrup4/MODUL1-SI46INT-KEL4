<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppointmentSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'psychiatrist_id',
        'date',
        'start_time',
        'end_time',
        'is_booked'
    ];

    /**
     * Get the psychiatrist that owns the slot
     */
    public function psychiatrist(): BelongsTo
    {
        return $this->belongsTo(Psych::class);
    }

    /**
     * Get the appointment for this slot
     */
    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class);
    }
}
