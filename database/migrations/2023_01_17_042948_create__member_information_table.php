<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MemberInformation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // 外部キー
            $table->timestamps();
            $table->string('phone_number');
            $table->string('address');
            $table->string('address2');

            //あくまで下記は制約しているだけでリレーションを組むのはsql文
            $table->foreign('user_id')->references('id')->on('member_lists');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MemberInformation');
    }
};
