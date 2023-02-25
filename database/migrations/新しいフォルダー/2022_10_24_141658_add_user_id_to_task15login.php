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
        Schema::create('task15login',function(Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('mail_address');
            $table->string('phone_number');
            $table->string('postcode');
            $table->string('Prefectures');
            $table->string('address2');
            $table->text('question');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login');
    }
};
