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
            $table->unsignedBigInteger('user_id');  // �O���L�[
            $table->timestamps();
            $table->string('number', 16); //�擪��0���͂������ꍇinteger���Ə�����\��������ׁAtext�ɂ���
            $table->string('expire_y', 4); //sql�ɏ������啶����ʂȂ��̂ŃJ�������͏������ɂ��Ă���
            $table->string('expire_m', 2); //sql�ɏ������啶����ʂȂ��̂ŃJ�������͏������ɂ��Ă���
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
