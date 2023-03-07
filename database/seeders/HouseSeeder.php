<?php

namespace Database\Seeders;

use App\Model\House;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('houses')->truncate();

        House::truncate();

        $csvFile = fopen(base_path("database/data/houses.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                House::create([
                    'name' => $data['0'],
                    'bedroom_count' => \intval($data['1']),
                    'bathroom_count' => \intval($data['2']),
                    'storey_count' => \intval($data['3']),
                    'garage_count' => \intval($data['4']),
                    'price' => \doubleval($data['1']),
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
