<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email1 = "cmoretti@commer.com";
        $userEmail1 = User::where('email', '=', $email1)->first();

        $email2 = "kevinj@thefishinhole.com";
        $userEmail2 = User::where('email', '=', $email2)->first();

        if ($userEmail1 === null) {
            User::create([
                'name' => 'Cary',
                'email' => $email1,
                'password' => bcrypt('fh-reports')
            ]);
        } 

        if ($userEmail2 === null) {
            User::create([
                'name' => 'Kevin',
                'email' => $email2,
                'password' => bcrypt('kevin-fh-reports')
            ]);
        }
   
    }
}