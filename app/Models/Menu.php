<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    use HasFactory;

    public function section() {
        return $this->belongsTo(MenuSection::class);
    }

    public function preference() {
        return $this->belongsTo(MenuPreference::class);
    }
}
