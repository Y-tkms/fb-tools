<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public function rsvSection() {
        return $this->belongsTo(RsvSection::class);
    }

    public function time() {
        return $this->belongsTo(Time::class);
    }

    public function date() {
        return $this->belongsTo(Date::class);
    }

    public function kids() {
        return $this->hasMany(Kid::class);
    }

    public function arrangements() {
        return $this->hasMany(Arrangement::class);
    }

    public function order() {
        return $this->hasOne(Order::class);
    }
}
