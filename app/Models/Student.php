<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    public function educationalInstitution():BelongsTo
    {
        return $this->belongsTo(EducationalInstitution::class);
    }

    public function residencyPositionApplications():HasMany
    {
        return $this->hasMany(ResidencyPositionApplication::class);
    }

    public function studentGrades(): HasMany
    {
        return $this->hasMany(StudentGrade::class);
    }

    public function studentLocationPreference(): HasOne
    {
        return $this->hasOne(StudentLocationPreference::class);
    }
}
