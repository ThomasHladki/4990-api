<?php

namespace Database\Seeders;

use App\Models\MedicalInstitution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicalInstitution::create([
            'name' => 'Windsor Regional Hospital',
            'type' => 'hospital',
            'street_address' => '1995 Lens Ave',
            'city' => 'Windsor',
            'province' => 'Ontario',
            'postal_code' => 'N8W 1L9',
            'email_domain' => 'wrh.on.ca'
        ]);

        MedicalInstitution::create([
            'name' => 'Montreal General Hospital',
            'type' => 'hospital',
            'street_address' => '1650 Cedar Ave',
            'city' => 'Montreal',
            'province' => 'Quebec',
            'postal_code' => 'H3G 1A4',
            'email_domain' => 'mgh.ca'
        ]);
    
        MedicalInstitution::create([
            'name' => 'Vancouver General Hospital',
            'type' => 'hospital',
            'street_address' => '899 West 12th Ave',
            'city' => 'Vancouver',
            'province' => 'British Columbia',
            'postal_code' => 'V5Z 1M9',
            'email_domain' => 'vgh.ca'
        ]);

        MedicalInstitution::create([
            'name' => 'Maple Leaf Clinic',
            'type' => 'clinic',
            'street_address' => '123 Maple St',
            'city' => 'Calgary',
            'province' => 'Alberta',
            'postal_code' => 'T2N 3S4',
            'email_domain' => 'mlclinic.ca'
        ]);

        MedicalInstitution::create([
            'name' => 'Sunnybrook Health Sciences Centre',
            'type' => 'hospital',
            'street_address' => '2075 Bayview Ave',
            'city' => 'Toronto',
            'province' => 'Ontario',
            'postal_code' => 'M4N 3M5',
            'email_domain' => 'sunnybrook.ca'
        ]);
    
        MedicalInstitution::create([
            'name' => 'St. Michael\'s Hospital',
            'type' => 'hospital',
            'street_address' => '30 Bond St',
            'city' => 'Toronto',
            'province' => 'Ontario',
            'postal_code' => 'M5B 1W8',
            'email_domain' => 'stmichaelshospital.com'
        ]);
    
        MedicalInstitution::create([
            'name' => 'BC Children\'s Hospital',
            'type' => 'hospital',
            'street_address' => '4480 Oak St',
            'city' => 'Vancouver',
            'province' => 'British Columbia',
            'postal_code' => 'V6H 3V4',
            'email_domain' => 'bcchildrens.ca'
        ]);
    
        MedicalInstitution::create([
            'name' => 'Calgary Medical Clinic',
            'type' => 'clinic',
            'street_address' => '789 Main St',
            'city' => 'Calgary',
            'province' => 'Alberta',
            'postal_code' => 'T2P 1J9',
            'email_domain' => 'calgarymedicalclinic.com'
        ]);
    
        MedicalInstitution::create([
            'name' => 'Quebec City General Hospital',
            'type' => 'hospital',
            'street_address' => '2705 Laurier Blvd',
            'city' => 'Quebec City',
            'province' => 'Quebec',
            'postal_code' => 'G1V 4G2',
            'email_domain' => 'qcg.ca'
        ]);

        MedicalInstitution::create([
            'name' => 'Hamilton General Hospital',
            'type' => 'hospital',
            'street_address' => '237 Barton St E',
            'city' => 'Hamilton',
            'province' => 'Ontario',
            'postal_code' => 'L8L 2X2',
            'email_domain' => 'hamiltonhealthsciences.ca'
        ]);
    
        MedicalInstitution::create([
            'name' => 'St. Paul\'s Hospital',
            'type' => 'hospital',
            'street_address' => '1081 Burrard St',
            'city' => 'Vancouver',
            'province' => 'British Columbia',
            'postal_code' => 'V6Z 1Y6',
            'email_domain' => 'providencehealthcare.org'
        ]);
    
        MedicalInstitution::create([
            'name' => 'Edmonton Medical Center',
            'type' => 'clinic',
            'street_address' => '500 University Ave',
            'city' => 'Edmonton',
            'province' => 'Alberta',
            'postal_code' => 'T6G 1Z2',
            'email_domain' => 'edmontonmedicalcenter.ca'
        ]);
    
        MedicalInstitution::create([
            'name' => 'Saskatoon General Hospital',
            'type' => 'hospital',
            'street_address' => '103 Hospital Dr',
            'city' => 'Saskatoon',
            'province' => 'Saskatchewan',
            'postal_code' => 'S7N 0W8',
            'email_domain' => 'saskatoonhealthregion.ca'
        ]);
    
        MedicalInstitution::create([
            'name' => 'Halifax Medical Clinic',
            'type' => 'clinic',
            'street_address' => '789 Barrington St',
            'city' => 'Halifax',
            'province' => 'Nova Scotia',
            'postal_code' => 'B3M 4Y2',
            'email_domain' => 'halifaxmedicalclinic.com'
        ]);

    }
}
