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
        $email1 = "mail@alenbarac.com";
        $userEmail1 = User::where('email', '=', $email1)->first();


        if ($userEmail1 === null) {
            User::create([
                'name' => 'Alen',
                'email' => $email1,
                'password' => bcrypt('fh-reports')
            ]);
        } 

   
    }
}