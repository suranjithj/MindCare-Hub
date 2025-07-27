<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            ['name' => 'Free', 'price' => 0.00, 'description' => 'Basic access to counseling features.'],
            ['name' => 'Standard', 'price' => 2499.99, 'description' => 'Standard package with limited premium features.'],
            ['name' => 'Premium', 'price' => 4999.99, 'description' => 'Full access to all features and counselors.'],
            ['name' => 'Custom', 'price' => 7999.99, 'description' => 'Tailored plan based on personal consultation.']
        ];

        foreach ($packages as $pkg) {
            Package::create($pkg);
        }
    }
}
