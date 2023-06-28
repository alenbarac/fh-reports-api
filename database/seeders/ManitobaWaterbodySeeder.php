<?php

namespace Database\Seeders;

use App\Models\Waterbody;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManitobaWaterbodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
         $manitoba_waterbodies = Waterbody::with(['region'])
          ->whereHas('region', function ($q) {
                $q->where('province_id',11);
            })->get();

            $ids = [];
            foreach($manitoba_waterbodies as $key=>$value) {
                $ids[] = $value->id;
            }
            $collection = Waterbody::whereIn('id', $ids)->get();

            foreach($collection as $waterbody) {
                $waterbody->latitude = $faker->latitude($min = 56, $max = 60);
                $waterbody->longitude = $faker->longitude($min = -95, $max = -98);

                $waterbody->save();
            }          
            
    }
}