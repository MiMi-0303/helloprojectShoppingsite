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
        Schema::create('credit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // 外部キー
            $table->timestamps();
            $table->string('number', 16); //先頭に0がはいった場合integerだと消える可能性がある為、textにする
            $table->string('expire_y', 4); //sqlに小文字大文字区別ないのでカラム名は小文字にしている
            $table->string('expire_m', 2); //sqlに小文字大文字区別ないのでカラム名は小文字にしている
            $table->text('name');
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
        Schema::dropIfExists('credit');
    }
};
