<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnaclesTable extends Migration
{
    public function up()
    {
        Schema::create('binnacles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action');
            $table->string('description');
            $table->string('small_description');
            $table->date('date');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('binnacles');
    }
}
