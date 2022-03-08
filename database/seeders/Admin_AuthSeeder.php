<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Admin_AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@yahoo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'), // password
            'remember_token' => null,
        ]);
    }
}
