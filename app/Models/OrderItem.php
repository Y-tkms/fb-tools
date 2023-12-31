<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RsvSection;

class OrderItem extends Model
{
    use HasFactory;

    public function rsvSection() {
        return $this->belongsTo(RsvSection::class);
    }
}
