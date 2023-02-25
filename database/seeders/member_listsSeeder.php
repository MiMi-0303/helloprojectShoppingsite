<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MemberList;
use Illuminate\Support\Facades\Hash;



class member_listsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = 
        ['id'=>'1','fullname' => '宮地', 'email' => 'noblesse--oblige', 'password' => Hash::make('Zoochoco01'),'phone_number'=>'090-XXXX-XXXX','address'=>'京都府','address2'=>'京都市','remember_token'=>'123456789','email_verified_at'=> now(),'user_id'=>'1'];
        $user = new MemberList;
        $user->fill($data)->save();
        $data = 
        ['id'=>'2','fullname' => '高橋', 'email' => 'takahashi_miyuki', 'password' => Hash::make('Takahashi01'),'phone_number'=>'090-XXXX-XXXX','address'=>'大阪府','address2'=>'大阪市','remember_token'=>'000000000','email_verified_at' => now(),'user_id'=>'2'];
        $user = new MemberList;
        $user->fill($data)->save();
        $data = 
        ['id'=>'3','fullname' => '山口', 'email' => 'yamaguchi_Moe', 'password' => Hash::make('Yamaguchi01'),'phone_number'=>'090-XXXX-XXXX','address'=>'滋賀県','address2'=>'大津市','remember_token'=>'987654321','email_verified_at' => now(),'user_id'=>'3'];
        $user = new MemberList;
        $user->fill($data)->save();

    }
}
