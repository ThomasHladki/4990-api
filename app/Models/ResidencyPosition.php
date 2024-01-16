<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResidencyPosition extends Model
{
    use HasFactory;

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function residencyPositionGrade(): HasMany
    {
        return $this->hasMany(ResidencyPositionGrade::class);
    }

    public function residencyPositionMatches(): HasMany
    {
        return $this->hasMany(ResidencyPositionMatch::class);
    }
}
