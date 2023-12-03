<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrangement extends Model
{
    use HasFactory;

    public function arr_item() {
        return $this->belongsTo(ArrItem::class);
    }

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }
}
