<?php

namespace Database\Seeders;

use App\Models\EducationalInstitution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('educational_institutions')->insert([
            'name' => 'University of Windsor',
            'medical_school_name' => 'Schulich School of Medicine & Dentistry',
            'street_address' => '123 University Avenue',
            'city' => 'Windsor',
            'province' => 'Ontario',
            'postal_code' => 'N1A 2B3',
            'email_domain' => 'uwindsor.ca',
        ]);

        EducationalInstitution::create([
            'name' => 'University of Toronto',
            'medical_school_name' => 'Faculty of Medicine',
            'street_address' => '1 King\'s College Circle',
            'city' => 'Toronto',
            'province' => 'Ontario',
            'postal_code' => 'M5S 1A8',
            'email_domain' => 'utoronto.ca',
        ]);
    
        EducationalInstitution::create([
            'name' => 'University of British Columbia',
            'medical_school_name' => 'Faculty of Medicine',
            'street_address' => '317 - 2194 Health Sciences Mall',
            'city' => 'Vancouver',
            'province' => 'British Columbia',
            'postal_code' => 'V6T 1Z3',
            'email_domain' => 'ubc.ca',
        ]);
    
        EducationalInstitution::create([
            'name' => 'McGill University',
            'medical_school_name' => 'Faculty of Medicine',
            'street_address' => '3655 Promenade Sir-William-Osler',
            'city' => 'Montreal',
            'province' => 'Quebec',
            'postal_code' => 'H3G 1Y6',
            'email_domain' => 'mcgill.ca',
        ]);
        
        EducationalInstitution::create([
            'name' => 'University of Alberta',
            'medical_school_name' => 'Faculty of Medicine and Dentistry',
            'street_address' => '2-59 Medical Sciences Building',
            'city' => 'Edmonton',
            'province' => 'Alberta',
            'postal_code' => 'T6G 2H7',
            'email_domain' => 'ualberta.ca',
        ]);
    
        EducationalInstitution::create([
            'name' => 'Dalhousie University',
            'medical_school_name' => 'Dalhousie Medical School',
            'street_address' => 'Sir Charles Tupper Medical Building, 5850 College Street',
            'city' => 'Halifax',
            'province' => 'Nova Scotia',
            'postal_code' => 'B3H 4R2',
            'email_domain' => 'dal.ca',
        ]);
    
        EducationalInstitution::create([
            'name' => 'University of Calgary',
            'medical_school_name' => 'Cumming School of Medicine',
            'street_address' => '3330 Hospital Drive NW',
            'city' => 'Calgary',
            'province' => 'Alberta',
            'postal_code' => 'T2N 4N1',
            'email_domain' => 'ucalgary.ca',
        ]);

        EducationalInstitution::create([
            'name' => 'University of Manitoba',
            'medical_school_name' => 'Max Rady College of Medicine',
            'street_address' => '770 Bannatyne Avenue',
            'city' => 'Winnipeg',
            'province' => 'Manitoba',
            'postal_code' => 'R3E 0W3',
            'email_domain' => 'umanitoba.ca',
        ]);
    
        EducationalInstitution::create([
            'name' => 'University of Ottawa',
            'medical_school_name' => 'Faculty of Medicine',
            'street_address' => '451 Smyth Road',
            'city' => 'Ottawa',
            'province' => 'Ontario',
            'postal_code' => 'K1H 8M5',
            'email_domain' => 'uottawa.ca',
        ]);
    
        EducationalInstitution::create([
            'name' => 'University of Saskatchewan',
            'medical_school_name' => 'College of Medicine',
            'street_address' => '107 Wiggins Road',
            'city' => 'Saskatoon',
            'province' => 'Saskatchewan',
            'postal_code' => 'S7N 5E5',
            'email_domain' => 'usask.ca',
        ]);
    
        EducationalInstitution::create([
            'name' => 'Memorial University of Newfoundland',
            'medical_school_name' => 'Faculty of Medicine',
            'street_address' => '300 Prince Philip Drive',
            'city' => 'St. John’s',
            'province' => 'Newfoundland and Labrador',
            'postal_code' => 'A1B 3V6',
            'email_domain' => 'mun.ca',
        ]);
    
        EducationalInstitution::create([
            'name' => 'Queen’s University',
            'medical_school_name' => 'Faculty of Health Sciences',
            'street_address' => '18 Barrie Street',
            'city' => 'Kingston',
            'province' => 'Ontario',
            'postal_code' => 'K7L 3N6',
            'email_domain' => 'queensu.ca',
        ]);
    
        EducationalInstitution::create([
            'name' => 'University of Sherbrooke',
            'medical_school_name' => 'Faculty of Medicine and Health Sciences',
            'street_address' => '3001 12e Avenue Nord',
            'city' => 'Sherbrooke',
            'province' => 'Quebec',
            'postal_code' => 'J1H 5N4',
            'email_domain' => 'usherbrooke.ca',
        ]);
    }
}
