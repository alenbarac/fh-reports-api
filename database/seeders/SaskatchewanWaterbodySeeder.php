<?php

namespace Database\Seeders;

use App\Models\Waterbody;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaskatchewanWaterbodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
         $saskat_waterbodies = Waterbody::with(['region'])
          ->whereHas('region', function ($q) {
                $q->where('province_id',14);
            })->get();

            $ids = [];
            foreach($saskat_waterbodies as $key=>$value) {
                $ids[] = $value->id;
            }
            $collection = Waterbody::whereIn('id', $ids)->get();

            foreach($collection as $waterbody) {
                $waterbody->latitude = $faker->latitude($min = 52, $max = 55);
                $waterbody->longitude = $faker->longitude($min = -104, $max = -106);

                $waterbody->save();
            }          
            
    }
}