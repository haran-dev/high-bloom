<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'user_id'     => 1,
                'company_name'=> 'High Bloom (Pvt) Ltd',
                // 'job'         => 'Super Admin',
                'country'     => 'Sri Lanka',
                'address'     => '274, Anbuvali puram, Trincomalee, Sri Lanka',
                'phone'       => '+94 70 226 3525',
                'email'       => 'highbloomenglishacademy@gmail.com',
                'status'      => 'active',
                'created_by'  => 1,
                'updated_by'  => null,
                'deleted_by'  => null,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
                'deleted_at'  => null,
            ],
            
        ]);
    }
}
