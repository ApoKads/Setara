<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $json = File::get(database_path('data/regions.json'));
         $regions = json_decode($json, true);

         $locations = [];

        foreach ($regions as $region) {
            foreach ($region['kota'] as $city) {
                $locations[] = [
                    'province' => $region['provinsi'],
                    'city' => $city,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        foreach (array_chunk($locations, 1000) as $chunk) {
            Location::insert($chunk);
        }
    }
}
