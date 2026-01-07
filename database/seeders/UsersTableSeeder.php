<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Haran & Brimine',
            'email' => 'harananthonyrajah@gmail.com',
            'about' => 'As the owner of High Bloom (Pvt) Ltd, I am responsible for overseeing the strategic direction, operational management, and overall growth of the company and its subsidiary ventures. My role includes providing leadership, ensuring financial and administrative accountability, and maintaining the highest standards of quality across all business operations. I am committed to fostering a culture of excellence, innovation, and continuous improvement, ensuring that each part of the organization delivers value to clients, learners, and stakeholders. Through careful planning, resource management, and active involvement in business strategy, I aim to create sustainable and impactful ventures that contribute to educational advancement, professional development, and positive social outcomes.',
            'job' => 'Owner',
            'country' => 'Sri Lanka',
            'address' => '274, Kalai Mahal Road, Anbuvalipuram, Trincomalee, Sri Lanka',
            'phone' => '+94 70 226 3525',

            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
