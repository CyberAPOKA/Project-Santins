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
        Schema::create('universidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->bigInteger("user_id")->unsigned()->nullable();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->string('alpha_two_code')->nullable();
            $table->string('country')->nullable();
            $table->string('domains')->nullable();
            $table->string('name')->nullable();
            $table->string('state_province')->nullable();
            $table->string('web_pages')->nullable();
            $table->string('status')->nullable()->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universidades');
    }
};
