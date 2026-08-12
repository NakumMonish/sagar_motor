<?php

namespace Database\Seeders;

use App\Models\CarCompany;
use Illuminate\Database\Seeder;

class CarCompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            'Maruti Suzuki',
            'Hyundai',
            'Tata',
            'Mahindra',
            'Kia',
            'Toyota',
            'Honda',
            'MG',
            'Skoda',
            'Volkswagen',
            'Ford',
            'Renault',
            'Nissan',
            'Jeep',
            'BMW',
            'Mercedes-Benz',
            'Audi',
            'Other'
        ];

        foreach ($companies as $company) {
            CarCompany::firstOrCreate(['name' => $company]);
        }
    }
}
