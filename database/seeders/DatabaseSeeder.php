<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MemberList;
use App\Models\MemberInformation;
use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //member_lists定義されてからMemberInformationが定義される、順番逆だった
        $this->call(member_listsSeeder::class);
        $this->call(MemberInformationSeeder::class);
        $this->call(ProductListsSeeder::class);

    }}

