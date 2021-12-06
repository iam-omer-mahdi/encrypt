<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'name' => Crypt::encrypt('ولاية شمال دارفور'),
        ]);
        DB::table('states')->insert([
            'name' => Crypt::encrypt('ولاية شرق دارفور'),
        ]);
        DB::table('states')->insert([
            'name' => Crypt::encrypt('ولاية جنوب دارفور'),
        ]);
        DB::table('states')->insert([
            'name' => Crypt::encrypt('ولاية غرب دارفور'),
        ]);
        DB::table('states')->insert([
        'name' => Crypt::encrypt('ولاية وسط دارفور'),
        ]);
    }
}
