<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //User
        // \App\Models\User::factory(10)->create();
       
        $user = new User();
        $user->firstName = 'Emon';
        $user->lastName = 'Raj';
        $user->mobile = '1234567890';
        $user->otp = 0;
        $user->email = 'user@mail.com';
        $user->password = 123;
        $user->save();
    }
}
