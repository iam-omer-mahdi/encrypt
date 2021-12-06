<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'مدير النظام',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '0900000001',
            'role' => 'superAdmin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
