<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResidencyPositionGrade extends Model
{
    use HasFactory;

    public function residencyPosition(): BelongsTo
    {
        return $this->belongsTo(ResidencyPosition::class);
    }
}
