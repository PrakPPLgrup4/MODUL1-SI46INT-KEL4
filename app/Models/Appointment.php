<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'psychiatrist_id',
        'appointment_category_id',
        'appointment_slot_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'payment_proof',
        'notes'
    ];

    /**
     * Get the user that owns the appointment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the psychiatrist for this appointment
     */
    public function psychiatrist(): BelongsTo
    {
        return $this->belongsTo(Psych::class);
    }

    /**
     * Get the category for this appointment
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(AppointmentCategory::class, 'appointment_category_id');
    }

    /**
     * Get the slot for this appointment
     */
    public function slot(): BelongsTo
    {
        return $this->belongsTo(AppointmentSlot::class, 'appointment_slot_id');
    }

    // Tentukan tipe kolom jika diperlukan (misalnya ULID)
    protected $casts = [
        'appointment_time' => 'datetime',
        'completed' => 'boolean',
    ];
}