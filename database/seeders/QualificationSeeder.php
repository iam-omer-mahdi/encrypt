<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qualifications')->insert([
            'name' => Crypt::encrypt('غير متعلم'),
        ]);
        DB::table('qualifications')->insert([
            'name' => Crypt::encrypt('الاساس'),
        ]);
        DB::table('qualifications')->insert([
            'name' => Crypt::encrypt('الثانوي'),
        ]);
        DB::table('qualifications')->insert([
            'name' => Crypt::encrypt('جامعي'),
        ]);
        DB::table('qualifications')->insert([
            'name' => Crypt::encrypt('دراسات عليا'),
        ]);
    }
}
