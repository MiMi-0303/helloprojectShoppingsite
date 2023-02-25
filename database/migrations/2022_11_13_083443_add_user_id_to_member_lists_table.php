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
        Schema::create('member_lists', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id');  // 外部キー
            $table->string('fullname');
            $table->string('email');
            $table->string('password');
            $table->string('phone_number');
            $table->string('address');
            $table->string('address2');
            $table->string('remember_token');
            $table->string('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //dropIfExistsは、引数である〇〇テーブルが存在していた場合、それを削除するメソッド
        Schema::dropIfExists('member_lists');
    }
};
