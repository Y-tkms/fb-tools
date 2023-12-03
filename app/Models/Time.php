<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    public function rsvSection() {
        return $this->belongsTo(RsvSection::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
