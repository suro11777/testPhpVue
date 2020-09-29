<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{
    /**
     *
     */
    public function run()
    {
        DB::table('languages')->insert([

            [
                'name' => 'Հայերեն',
                'iso' => 'HY',
                'is_main' => 1
            ],
            [
                'name' => 'English',
                'iso' => 'EN',
                'is_main' => 0
            ],
            [
                'name' => 'Русский',
                'iso' => 'RU',
                'is_main' => 0

            ]
        ]);
    }
}