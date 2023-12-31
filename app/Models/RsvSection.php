<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsvSection extends Model
{
    use HasFactory;

    public function times() {
        return $this->hasMany(Time::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
}
