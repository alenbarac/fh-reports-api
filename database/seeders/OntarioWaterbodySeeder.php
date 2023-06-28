<?php

namespace Database\Seeders;

use App\Models\Waterbody;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OntarioWaterbodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
         $ontario_waterbodies = Waterbody::with(['region'])
          ->whereHas('region', function ($q) {
                $q->where('province_id',15);
            })->get();

            $ids = [];
            foreach($ontario_waterbodies as $key=>$value) {
                $ids[] = $value->id;
            }
            $collection = Waterbody::whereIn('id', $ids)->get();

            foreach($collection as $waterbody) {
                $waterbody->latitude = $faker->latitude($min = 45, $max = 50);
                $waterbody->longitude = $faker->longitude($min = -80, $max = -85);

                $waterbody->save();
            }          
            
    }
}