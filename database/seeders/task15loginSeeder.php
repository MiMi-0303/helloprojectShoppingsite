<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class task15loginSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task15login')->insert([
            'fullname' => '1山田太郎',
            'mail_address' => '1hogehoge@yahoo.jp',
            'phone_number'=> '1090-XXX-XXXX',
            'postcode' =>'1XXX-XXXX',
            'Prefectures' =>'1京都府',
            'address2' =>'1長岡京市',
            'question' =>'1●●がXXです',
        ]);
        DB::table('task15login')->insert([
            'fullname' => '2山田太郎',
            'mail_address' => '2hogehoge@yahoo.jp',
            'phone_number'=> '2090-XXX-XXXX',
            'postcode' =>'2XXX-XXXX',
            'Prefectures' =>'2京都府',
            'address2' =>'2長岡京市',
            'question' =>'2●●がXXです',
        ]);
        DB::table('task15login')->insert([
            'fullname' => '3山田太郎',
            'mail_address' => '3hogehoge@yahoo.jp',
            'phone_number'=> '3090-XXX-XXXX',
            'postcode' =>'3XXX-XXXX',
            'Prefectures' =>'3京都府',
            'address2' =>'3長岡京市',
            'question' =>'3●●がXXです',
        ]);

    }
}
