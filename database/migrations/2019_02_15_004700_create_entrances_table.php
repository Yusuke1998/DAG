<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrancesTable extends Migration
{
    public function up()
    {
        Schema::create('entrances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reception');
            $table->string('commentary')->nullable();
            $table->string('date');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entrances');
    }
}
