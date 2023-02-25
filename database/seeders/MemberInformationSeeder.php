<?php

namespace Database\Seeders;

use App\Models\MemberInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('MemberInformation')->insert([

            'phone_number' => '090-XXXX-XXXX',
            'address' => '京都府',
            'address2' => '京都市',
            'user_id' => '1'
        ]);
        DB::table('MemberInformation')->insert([


            'phone_number' => '090-XXXX-XXXXs',
            'address' => '大阪府',
            'address2' => '大阪市',
            'user_id' => '2'

        ]);
        DB::table('MemberInformation')->insert([


            'phone_number' => '090-XXXX-XXXX',
            'address' => '滋賀県',
            'address2' => '滋賀県',
            'user_id' => '3'

        ]);
    }
}
