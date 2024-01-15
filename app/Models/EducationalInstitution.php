<?php

/**
 * @var Integer $id
 * @var string $name
 * @var string $medical_school_name
 * @var string $street_address
 * @var string $city
 * @var string $province
 * @var string $postal_code
 * @var string $email_domain
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
