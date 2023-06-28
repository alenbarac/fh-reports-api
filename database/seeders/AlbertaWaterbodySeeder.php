<?php

namespace Database\Seeders;

use App\Models\Waterbody;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbertaWaterbodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
         $alberta_waterbodies = Waterbody::with(['region'])
          ->whereHas('region', function ($q) {
                $q->where('province_id', env('DEFAULT_LANDING_PAGE_PROVINCE', 13));
            })->get();

            $ids = [];
            foreach($alberta_waterbodies as $key=>$value) {
                $ids[] = $value->id;
            }
            $collection = Waterbody::whereIn('id', $ids)->get();

            foreach($collection as $waterbody) {
                $waterbody->latitude = $faker->latitude($min = 52, $max = 55);
                $waterbody->longitude = $faker->longitude($min = -110, $max = -115);

                $waterbody->save();
            }          
            
    }
}