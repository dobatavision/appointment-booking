<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'appointment_time', 'description', 'notification_method'];

    protected $casts = [
        'appointment_time' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
