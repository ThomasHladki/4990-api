<?php

/**
 * @property int $id
 * @property string $name
 * @property string $medical_school_name
 * @property string $street_address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $email_domain
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationalInstitution extends Model
{
    use HasFactory;

    public function Students(): HasMany
    {
        return $this->hasMany(Student::class);  
    }
}
