<?php

namespace Database\Seeders;

use App\Models\Waterbody;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BCWaterbodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
         $bc_waterbodies = Waterbody::with(['region'])
          ->whereHas('region', function ($q) {
                $q->where('province_id',12);
            })->get();

            $ids = [];
            foreach($bc_waterbodies as $key=>$value) {
                $ids[] = $value->id;
            }
            $collection = Waterbody::whereIn('id', $ids)->get();

            foreach($collection as $waterbody) {
                $waterbody->latitude = $faker->latitude($min = 50, $max = 53);
                $waterbody->longitude = $faker->longitude($min = -122, $max = -127);

                $waterbody->save();
            }          
            
    }
}